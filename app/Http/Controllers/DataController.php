<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Kabupaten;
use App\Data;
use App\Data2;
use App\Kecamatan;
use App\Kelurahan;
use Carbon\Carbon as Carbon;

class DataController extends Controller
{
   
	private $dateTimeNow;
    private $dateNow;
    private $dateFormatName;
    private $dateFormatName1;

    public function __construct()
    {
    	//inisialisasi
        $this->dateTimeNow = Carbon::now()->addHours(8);
        $this->dateNow = Carbon::now()->format('Y-m-d');
        $this->dateFormatName = Carbon::now()->locale('id')->isoFormat('LL');
    }

    //fungsi crud
    public function index(){
        $tanggalSekarang = CARBON::now()->locale('id')->isoFormat('LL');
        $dateNow = Carbon::now()->format('Y-m-d');
        $data_covid = Data2::select('id_data2','nama_kab','kecamatan','kelurahan','level','ppln','ppdn','tl','lainnya','meninggal','sembuh','positif','tanggal','rawat')   -> rightjoin('tb_kelurahan','tb_data_covid_2.id_kel','=','tb_kelurahan.id_kel')
                -> rightjoin('tb_kecamatan','tb_kelurahan.id_kecamatan','=','tb_kecamatan.id_kec')
                -> rightjoin('tb_kabupaten','tb_kecamatan.id_kabupaten','=','tb_kabupaten.id_kab')
                ->where('tanggal', $dateNow)->orderBy('positif','desc')->paginate(20);

        $meninggal = Data2::select(DB::raw('COALESCE(SUM(meninggal),0) as meninggal'))->get();
        $positif = Data2::select(DB::raw('COALESCE(SUM(positif),0) as positif'))->get();
        $rawat = Data2::select(DB::raw('COALESCE(SUM(rawat),0) as rawat'))->get();
        $sembuh = Data::select(DB::raw('COALESCE(SUM(sembuh),0) as sembuh'))->get();    
        $kabupaten=Kabupaten::get();
        $kecamatan=Kecamatan::get();
        $kelurahan=Kelurahan::get();

        return view('data.index',compact("kabupaten","data_covid","dateNow","meninggal","positif","rawat","sembuh","tanggalSekarang","kecamatan","kelurahan"));
    }

    public function create(Request $request){

        
        $kelurahan = $request->kelurahan;
        $tanggal = $request->tanggal;
        $rawat= $request->rawat;
        $sembuh= $request->sembuh;
        $meninggal= $request->meninggal;
        $positif= $request->positif;
        $ppln = $request->ppln;
        $ppdn = $request->ppdn;
        $tl= $request->tl;
        $level= $request->level;
        $lainnya= $request->lainnya;

        $data = array(
        'Kelurahan' => $kelurahan,
        'Tanggal' => $tanggal
        );

        $count = DB::table('tb_data_covid_2')->where('id_kel', $kelurahan)->where('tanggal',  $tanggal)->count();

        if($count > 0){
            return redirect()->back();
        }else{
            $data_covid = new Data2;
            $data_covid->tanggal= $request->tanggal;
            $data_covid->id_kel= $request->kelurahan;
            $data_covid->sembuh = $request->sembuh;
            $data_covid->rawat= $request->rawat;
            $data_covid->positif= $positif;
            $data_covid->ppln= $request->ppln;
            $data_covid->ppdn= $request->ppdn;
            $data_covid->tl= $request->tl;
            $data_covid->lainnya= $request->lainnya;
            $data_covid->level= $request->level;
            $data_covid->save();
        }


    	return redirect ('/data')->with('sukses', 'Data Berhasil Disimpan');


    }

    public function edit($id){
    	$data_covid= Data2::select('id_data2','nama_kab','kecamatan','kelurahan','level','ppln','ppdn','tl','lainnya','meninggal','sembuh','positif','tanggal','rawat')   -> rightjoin('tb_kelurahan','tb_data_covid_2.id_kel','=','tb_kelurahan.id_kel')
                -> rightjoin('tb_kecamatan','tb_kelurahan.id_kecamatan','=','tb_kecamatan.id_kec')
                -> rightjoin('tb_kabupaten','tb_kecamatan.id_kabupaten','=','tb_kabupaten.id_kab')
                ->where('id_data2',$id)->get();
    	return view('data/edit',['data_covid'=>$data_covid]);
    }

    public function update(Request $request, $id){
    	$data_covid = Data2::where('id_data2',$id);
    	$data_covid->where('id_data2',$request->id)->update([
        'rawat' => $request->rawat,
        'sembuh' => $request->sembuh,
        'meninggal' => $request->meninggal,
        'positif' => $request->positif,
        'tanggal' => $request->tanggal,
        'ppln' => $request->ppln,
        'ppdn' => $request->ppdn,
        'tl' => $request->tl,
        'lainnya' => $request->lainnya,
        'level' => $request->level
    ]);
        

	/*	    $data = array(
        'Kabupaten' => $kabupaten,
        'Tanggal' => $tgl_data
    );

    $count = DB::table('tb_data')->where('id_kabupaten', $kabupaten)
                                ->where('tgl_data',  $tgl_data)
                                ->count();
    if($count > 0){
        return redirect()->back();
    }else{
        // DB::table('teammembersall')->insert($data);
        $data = new Data;
        $data->tgl_data= $request->tgl_data;
        $data->id_kabupaten= $request->kabupaten;
        $data->sembuh = $request->sembuh;
        $data->rawat= $request->rawat;
        $data->positif= $positif;
        $data->meninggal= $request->meninggal;
        $data->save();
    }
    ]);*/


    	return redirect('/data')->with('sukses', 'Data Berhasil Diupdate');
    }

    public function delete($id){
    	$data_covid = Data2::where('id_data2',$id);
    	$data_covid->delete($data_covid);
    	return redirect('/data')->with('sukses', 'Data Berhasil Dihapus');
    }

    public function search(Request $request){
        $tanggal = $request->tanggal;
        $kabupaten=Kabupaten::get();
        $kecamatan=Kecamatan::get();
        $kelurahan=Kelurahan::get();
        $tanggalSekarang = Carbon::parse($request->tanggal)->format('d F Y');
        $cekData = Data2::select('id_data2','nama_kab','kecamatan','kelurahan','level','ppln','ppdn','tl','lainnya','meninggal','sembuh','positif','tanggal','rawat')   -> rightjoin('tb_kelurahan','tb_data_covid_2.id_kel','=','tb_kelurahan.id_kel')
                -> rightjoin('tb_kecamatan','tb_kelurahan.id_kecamatan','=','tb_kecamatan.id_kec')
                -> rightjoin('tb_kabupaten','tb_kecamatan.id_kabupaten','=','tb_kabupaten.id_kab')
            ->where('tanggal',$request->tanggal)
            ->orderBy('tb_data_covid_2.id_kel','ASC')
            ->get();
        if (count($cekData) == 0) {
            $data_covid = Kabupaten::select('kelurahan',DB::raw('IFNULL("0",0) as meninggal'), DB::raw('IFNULL("0",0) as positif'), DB::raw('IFNULL("0",0) as rawat'),DB::raw('IFNULL("0",0) as sembuh'), DB::raw('IFNULL("0",0) as ppln'), DB::raw('IFNULL("0",0) as ppdn'), DB::raw('IFNULL("0",0) as level'), DB::raw('IFNULL("0",0) as lainnya'), DB::raw('IFNULL("0",0) as tl'))->get();
        }else{
            $data_covid = $cekData;
        }

        $meninggal = Data2::select(DB::raw('COALESCE(SUM(meninggal),0) as meninggal'))->where('tanggal',$request->tanggal)->get();
        $positif = Data2::select(DB::raw('COALESCE(SUM(positif),0) as positif'))->where('tanggal',$request->tanggal)->get();
        $rawat = Data2::select(DB::raw('COALESCE(SUM(rawat),0) as rawat'))->where('tanggal',$request->tanggal)->get();
        $sembuh = Data2::select(DB::raw('COALESCE(SUM(sembuh),0) as sembuh'))->where('tanggal',$request->tanggal)->get();
        
        return view('data.index',compact("data_covid","meninggal","positif","rawat","sembuh","tanggalSekarang","tanggal","kabupaten","kecamatan","kelurahan"));


    }

        public function search2(Request $request){
        $tanggal = $request->tanggal;
        $kabupaten=Kabupaten::get();
        $kecamatan=Kecamatan::get();
        $kelurahan=Kelurahan::get();
        $tanggalSekarang = Carbon::parse($request->tanggal)->format('d F Y');
            $this->validate($request, [
        'limit' => 'integer',
    ]);
        $data_covid = Data2::when($request->keyword, function ($query) use ($request) {
            $query->where('kelurahan', 'like', "%{$request->keyword}%") // search by email
                ->orWhere('kecamatan', 'like', "%{$request->keyword}%"); // or by name
        })->paginate($request->limit ? $request->limit : 20);

        $users->appends($request->only('keyword'));

        $meninggal = Data2::select(DB::raw('COALESCE(SUM(meninggal),0) as meninggal'))->where('tanggal',$request->tanggal)->get();
        $positif = Data2::select(DB::raw('COALESCE(SUM(positif),0) as positif'))->where('tanggal',$request->tanggal)->get();
        $rawat = Data2::select(DB::raw('COALESCE(SUM(rawat),0) as rawat'))->where('tanggal',$request->tanggal)->get();
        $sembuh = Data2::select(DB::raw('COALESCE(SUM(sembuh),0) as sembuh'))->where('tanggal',$request->tanggal)->get();
        
        return view('data.index',compact("data_covid","meninggal","positif","rawat","sembuh","tanggalSekarang","tanggal","kabupaten","kecamatan","kelurahan"));
        $this->validate($request, [
            'limit' => 'integer',
        ]);



    }
    
}
