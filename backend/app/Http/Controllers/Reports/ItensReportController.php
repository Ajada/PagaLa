<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Reports\DompdfController;
use App\Models\Companies;
use App\Models\Itens;
use Carbon\Carbon;

class ItensReportController extends Controller
{
    protected $domPdf;
    protected $itens;

    public function __construct()
    {
        $this->domPdf = new DompdfController();
    }

    public function generateReport($itenId, $type = 'general') {
        if($type !== 'general')
            $this->itens = $this->getIten($itenId);
        else
            $this->itens = $this->getInventory();
        
        if(! $this->itens)
            return response()->json(['error' => true, 'msg' => 'Iten not found'], 404);

        $page = view('reports.simple.inventory')->with([
            'itensData' => $this->itens,
            'companyLogo' => $this->getLogoByCompany($itenId)
        ]);

        $pdf = $this->domPdf->generatePdf(
            $page,
            'Relatório do Estoque - ' . Carbon::now()->format('d-m-Y H-m-s')
        );

        return response()->json(['temp' => $pdf]);
    }

    protected function getIten($id) {
        $itens = new Itens();

        $itens = $itens->find($id);

        if(! $itens)
            return false;
        
        return $itens->where('id', $id)->get([
            'name',
            'CA',
            'validity',
            'inventory',
            'maker',
            'supplier'
        ]);
    }

    protected function getInventory() {
        $itens = new Itens();

        $itens = $itens->get([
            'name',
            'CA',
            'validity',
            'inventory',
            'maker',
            'supplier'
        ]);

        return $itens;
    }

    public function getLogoByCompany($itenId) {
        $iten = new Itens();
        $company = new Companies();

        $iten = $iten->where('id', $itenId)->first('company_id');

        if(! $iten)
            return 'https://protege.wolftechti.com.br/img/protege.73495e67.png';

        $companyLogo = $company->find($iten->company_id)->first('photo');

        $companyLogo = 
            $companyLogo->photo ? env('IMAGE_SERVE_URL') . 'storage/' . $companyLogo->photo : 'https://protege.wolftechti.com.br/img/protege.73495e67.png';

        return $companyLogo;
    }


}   
