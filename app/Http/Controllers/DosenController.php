<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    protected $keilmuanDosen = [
        'Pemrograman', 
        'Sistem Operasi', 
        'Jaringan Komputer', 
        'Pengembangan Web',
        'Pengembangan Aplikasi Mobile',
        'Kecerdasan Buatan (AI)',
        'Pengolahan Citra dan Grafika Komputer',
        'Keamanan Informasi',
        'Rekayasa Perangkat Lunak',
        'Komputasi Awan',
        'IOT'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.dosen.index', [
            'dosens' => Dosen::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nidn' => 'required|max:10|unique:dosens',
            'nama' => 'required',
            'email' => 'nullable',
            'singkatan' => 'nullable|max:3',
            'nomor_telepon' => 'nullable|min:10|max:13',
            'kuota_pembimbing' => 'nullable|min:1',
            'keilmuan' => 'nullable',
        ]);

        

        // $dosen = new Dosen($validatedData);
        // $singkatan = Str::lower($request->singkatan);
        
        $user = new User();
        $user->level_user = 'dospem';
        $user->status_user = false;
        $user->name = $validatedData['nama'];
        // $user->username = $request->nidn;
        $user->username = $request->nidn . Str::lower($validatedData['singkatan']);
        $user->password = Hash::make($request->nidn);
        // $user->password = Hash::make($request->nidn . Str::lower($request->singkatan));


        $user->save();
        $dosen = Dosen::create([
            'user_id' => $user->id, // Assign user_id with the newly created user's id
            'level_user' => 'dospem',
            'nidn' => $validatedData['nidn'],
            'nama' => $validatedData['nama'],
            'singkatan' => $validatedData['singkatan'],
            'nomor_telepon' => $validatedData['nomor_telepon'],
            'kuota_pembimbing' => $validatedData['kuota_pembimbing'],
            'keilmuan' => $validatedData['keilmuan'],
        ]);

        // Dosen::create($validatedData);
        // $dosen->user()->save($user);
        

        return redirect('dashboard/dosen')->with('success', 'New Dosen has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('dashboard.dosen.edit', [
            'dosen' => $dosen,
            'keilmuanDosen' => $this->keilmuanDosen,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nidn' => 'required|max:10',
            'nama' => 'required',
            'singkatan' => 'nullable|max:3',
            'nomor_telepon' => 'nullable|min:10|max:13',
            'kuota_pembimbing' => 'nullable|min:1',
            'keilmuan' => 'nullable',
        ]);


        // Dosen::where('id', $dosen->id)->update($validatedData);
        $dosen->update($validatedData);

        $user = $dosen->user;
        if ($user) {
            $user->name = $validatedData['nama'];
            $user->username = $validatedData['nidn'] . Str::lower($validatedData['singkatan']);
            $user->password = Hash::make($validatedData['nidn']);
            $user->save();
        }

        return redirect('dashboard/dosen')->with('success', 'Dosen has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        // Dosen::destroy($dosen->id);
        $user = $dosen->user; 
        if ($user) {
            $user->delete();
        }
        $dosen->delete();

        return redirect('dashboard/dosen')->with('success', 'Dosen and associated User have been deleted!');
        
        // return redirect('dashboard/dosen')->with('success', 'Dosen has been deleted!');
    }

    public function toggleStatus(Dosen $dosen)
    {
        $dosen->toggleStatus();

        return redirect('dashboard/dosen')->with('success', 'Status user berhasil diubah.');
    }

    public function import() {
        $file = $request->file('excel_file');

        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];

        foreach ($worksheet->getRowIterator() as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }
            $data[] = $rowData;
        }

        return $data;

        $user = new User();
        $user->level_user = 'dospem';
        $user->status_user = false;
        $user->name = $validatedData['nama'];
        // $user->username = $request->nidn;
        $user->username = $request->nidn . Str::lower($validatedData['singkatan']);
        $user->password = Hash::make($request->nidn);
        // $user->password = Hash::make($request->nidn . Str::lower($request->singkatan));


        $user->save();

        foreach ($data as $row) {
            Mahasiswa::create([
                'npm' => $row[0],
                'nama' => $row[1],
                'kelas' => $row[2],
                'email' => $row[3],
                'prodi' => $row[4],
            ]);
        }

        return redirect()->route('data-list')->with('success', 'Data imported successfully.');
    }

    public function exportToPDF() {

    }

    public function exportToExcel() {
        
    }
}
