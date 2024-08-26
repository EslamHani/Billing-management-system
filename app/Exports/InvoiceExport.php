<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvoiceExport implements FromCollection, ShouldAutoSize, WithHeadings
{

	public function headings() : array
	{
		return [
			'رقم الفاتورة', 
			'اسم العميل', 
			'رقم العميل', 
			'الاجمالي', 
			'مصاريف الشحن',
			'شركة الشحن' ,
			'حالة الفاتورة',
			'اسم البائع',
			'تاريخ الاصدار', 
		];
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {	
    	return collect(Invoice::getInvoice());
        //return Invoice::all();
    }
}
