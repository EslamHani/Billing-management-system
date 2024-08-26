<?php

namespace App\Http\Controllers\BackEnd;

// use Excel;
use App\Models\Order;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Exports\InvoiceExport;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    protected $modelName;
    protected $routeName;
    protected $pageName;
    protected $viewName;

    public function __construct(Invoice $model)
    {
        $this->modelName = $model;
        $this->routeName = "invoices";
        $this->pageName  = "Invoices";
        $this->viewName  = "backend.invoices.";
    }

    public function append()
    {
        $array = [
            'governorates' => Governorate::all(),
        ];

        return $array;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('invoices_list');
        $records = $this->modelName->with('order')->orderBy('id', 'desc')->get();
                        
        return view($this->viewName.'index', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'records'   => $records,
            'trash'     => false
        ]);
    }


    public function paidInvoices()
    {
        $this->authorize('invoices_paidlist');
        $records = $this->modelName->with('order')
            ->where('payment_status', 'paid')
            ->orderBy('id', 'desc')
            ->get();
        $this->pageName = 'paid_invoices';                

        return view($this->viewName.'paidinvoice', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'records'   => $records,
            'trash'     => false
        ]);
    }

    public function unpaidInvoices()
    {
        $this->authorize('invoices_unpaidlist');
        $records = $this->modelName->with('order')
            ->where('payment_status', 'unpaid')
            ->orderBy('id', 'desc')
            ->get();
        $this->pageName = 'unpaid_invoices';
                        
        return view($this->viewName.'unpaidinvoice', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'records'   => $records,
            'trash'     => false
        ]);
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $this->authorize('invoices_archivelist');
        $records = $this->modelName->onlyTrashed()
                    ->with('order')
                    ->orderBy('id', 'desc')
                    ->get();

        $this->pageName = "Invoices_Archive";
        return view($this->viewName.'index', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'records'   => $records,
            'trash'     => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('invoices_update');
        $record = $this->modelName->with('order')->findOrFail($id);
        $append = $this->append();
        return view($this->viewName.'edit', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'viewName'  => $this->viewName,
            'record'    => $record,
        ])->with($append);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('invoices_update');
        $record = $this->modelName->findOrFail($id);

        $validatedData = $request->validate([
        	'shipping_company' => ['required', 'string'],
        	'payment_status' => ['required', Rule::in(['paid', 'unpaid'])],
        ]);

        $record->update([
            'shipping_company' => $validatedData['shipping_company'],
            'payment_status' => $validatedData['payment_status'],
        ]);
        
        return redirect()->route($this->routeName.'.index')
                ->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('invoices_delete');
        $record = $this->modelName->withTrashed()->with('order')->findOrFail($id);

        foreach($record->order->products as $product)
        {
            $quantity = $product->pivot->quantity;
            $product = Product::findOrFail($product->id);
            $product->update(['stock' => $product->stock + $quantity]);
        }
        $record->order->delete();
        $record->forceDelete();
        return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم الحذف بنجاح');
    }

    // This function used to delete all checked records
    public function deleteAll(Request $request)
    {
        $this->authorize('invoices_delete');
        $ids = $request->ids;
        $count = count($ids);
        foreach($ids as $id)
        {
            $record = $this->modelName->with('order')->findOrFail($id);
            foreach($record->order->products as $product)
            {
                $quantity = $product->pivot->quantity;
                $product = Product::findOrFail($product->id);
                $product->update(['stock' => $product->stock + $quantity]);
            }
            $record->order->delete();
            $record->forceDelete();
        }
         return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف '.$count.' من السجلات بنجاح');
    }

    // This function used to archive record
    public function archive($id)
    {
        $this->authorize('invoices_archive');
        $record = $this->modelName->findOrFail($id);

        $record->delete();
        return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم ارشفة السجل بنجاح');
    }

    // This function used to archive all records checked
    public function archiveAll(Request $request)
    {
        $this->authorize('invoices_archive');
        $ids = $request->ids;
        $count = count($ids);
        foreach($ids as $id)
        {
            $record = $this->modelName->findOrFail($id);

            $record->delete();
        }
         return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف '.$count.' من السجلات بنجاح');
    }

    // This function used to restore record from archived
    public function restore($id)
    {
        $this->authorize('invoices_archive');
        $this->modelName->withTrashed()->where('id', $id)->restore();

        return redirect()->route($this->routeName.'.trash')
                    ->with('success', 'تم حذف السجل من الارشيف بنجاح');
    }

    // this function used to print invoice
    public function printInvoive($id)
    {
        $this->authorize('invoices_print');
    	$record = $this->modelName->with('order')->findOrFail($id);
        $append = $this->append();
        return view($this->viewName.'printInvoice', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'viewName'  => $this->viewName,
            'record'    => $record,
        ])->with($append);
    }

    // This function to export excel file xlsx
    public function exportIntoExcel()
    {
        return Excel::download(new InvoiceExport, 'invoices.xlsx');
    }
}