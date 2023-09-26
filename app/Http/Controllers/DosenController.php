<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Dompdf\Dompdf;
use Dompdf\Options;

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
            'singkatan' => Str::upper($validatedData['singkatan']),
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

        $validatedData['singkatan'] = Str::upper($validatedData['singkatan']);
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

    public function import(Request $request) {
        $validatedData = $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls', // Memeriksa apakah file terlampir dan memiliki ekstensi yang benar
        ]);
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

        $headers = array_shift($data); // Ambil baris pertama sebagai header

        foreach ($headers as $header) {
            $newHeader[] = Str::lower($header);
        }

        // Cari indeks kolom yang sesuai dengan nama-nama header
        // $nidnIndex = array_search('NIDN', $header);
        // $namaIndex = array_search('Nama', $header);
        // $emailIndex = array_search('Email', $header);
        // $singkatanIndex = array_search('Singkatan', $header);
        // $nomorTeleponIndex = array_search('Nomor Telepon', $header);
        // $kuotaPembimbingIndex = array_search('Kuota Pembimbing', $header);
        // $keilmuanIndex = array_search('Keilmuan', $header);

        $nidnIndex = array_search('nidn', $newHeader);
        $namaIndex = array_search('nama', $newHeader);
        $emailIndex = array_search('email', $newHeader);
        $singkatanIndex = array_search('singkatan', $newHeader);
        $nomorTeleponIndex = array_search('nomor telepon', $newHeader);
        $kuotaPembimbingIndex = array_search('kuota pembimbing', $newHeader);
        $keilmuanIndex = array_search('keilmuan', $newHeader);

        $users = User::all();
        // $dosen = Dosen::all();

        foreach ($data as $row) {
            $username = $row[$nidnIndex] . Str::lower($row[$singkatanIndex]);
            $nidn = $row[$nidnIndex];

            // dd($users->contains('username', $row[$nidnIndex] . Str::lower($row[$singkatanIndex])));
            if (!$users->contains('username', $username)) {
                $user = new User();

                $user->level_user = 'dospem';
                $user->status_user = false;
                $user->name = $row[$namaIndex];
                $user->username = $row[$nidnIndex] . Str::lower($row[$singkatanIndex]);
                $user->password = Hash::make($row[$nidnIndex]);
                $user->save();
                // $user = User::create([
                //     'level_user' => 'dospem',
                //     'status_user' => false,
                //     'name' => $row[$namaIndex],
                //     'username' => $username,
                //     'password' => Hash::make($row[$nidnIndex]),
                // ]);
                
                Dosen::create([
                    'user_id' => $user->id, 
                    'level_user' => $user->level_user,
                    'status_user' => $user->status_user,
                    'nidn' => $row[$nidnIndex],
                    'nama' => $row[$namaIndex],
                    'singkatan' => Str::upper($row[$singkatanIndex]),
                    'nomor_telepon' => $row[$nomorTeleponIndex],
                    'kuota_pembimbing' => $row[$kuotaPembimbingIndex],
                    'keilmuan' => $row[$keilmuanIndex],
                ]);
            }else {
                User::where('username', $username)->update([
                    'name' => $row[$namaIndex],
                    'username' => $row[$nidnIndex] . Str::lower($row[$singkatanIndex]),
                    'password' => Hash::make($row[$nidnIndex]),
                ]);

                Dosen::where('nidn', $nidn)->update([
                    'nidn' => $row[$nidnIndex],
                    'nama' => $row[$namaIndex],
                    'singkatan' => Str::upper($row[$singkatanIndex]),
                    'nomor_telepon' => $row[$nomorTeleponIndex],
                    'kuota_pembimbing' => $row[$kuotaPembimbingIndex],
                    'keilmuan' => $row[$keilmuanIndex],
                ]);
            }

            
        }

        if ($file->isValid()) {
            unlink($file->getPathname()); // Menghapus file dari direktori sementara
        }

        return redirect('dashboard/dosen')->with('success', 'Data imported successfully.');
    }
    

    public function exportToPDF() {
        $dosens = Dosen::all();

        $options = new Options();
        $options->set('defaultFont', 'Arial'); // Atur font default

        $dompdf = new Dompdf($options);

        $pdfView = view('dashboard.pdf.dosen', compact('dosens')); // Gunakan view PDF khusus
        $dompdf->loadHtml($pdfView);

        // (Opsional) Atur ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        return $dompdf->stream('dosen_data.pdf');
    }

    public function exportToExcel() {
        $dosens = Dosen::all();

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        // Menambahkan header ke worksheet
        $worksheet->setCellValue('A1', 'ID');
        $worksheet->setCellValue('B1', 'NIDN');
        $worksheet->setCellValue('C1', 'Nama');
        $worksheet->setCellValue('D1', 'Singkatan');
        $worksheet->setCellValue('E1', 'Email');
        $worksheet->setCellValue('F1', 'Nomor Telepon');
        $worksheet->setCellValue('G1', 'Kuota Pembimbing');
        $worksheet->setCellValue('H1', 'Keilmuan');

        // Menambahkan data ke worksheet
        $rowIndex = 2;
        foreach ($dosens as $dosen) {
            $worksheet->setCellValue('A' . $rowIndex, $dosen->id);
            $worksheet->setCellValue('B' . $rowIndex, $dosen->nidn);
            $worksheet->setCellValue('C' . $rowIndex, $dosen->nama);
            $worksheet->setCellValue('D' . $rowIndex, $dosen->singkatan);
            $worksheet->setCellValue('E' . $rowIndex, $dosen->email);
            $worksheet->setCellValue('F' . $rowIndex, $dosen->nomor_telepon);
            $worksheet->setCellValue('G' . $rowIndex, $dosen->kuota_pembimbing);
            $worksheet->setCellValue('H' . $rowIndex, $dosen->keilmuan);
            $rowIndex++;
        }

        $xlsxWriter = new Xlsx($spreadsheet);
        $xlsxWriter->save('dosen_data.xlsx');

        return response()->download('dosen_data.xlsx')->deleteFileAfterSend();
    }

    public function pencarian(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $dosens = Dosen::where('nama', 'LIKE', "%$keyword%")
                        ->orWhere('nidn', 'LIKE', "%$keyword%")
                        ->get();

        return response()->json(['dosens' => $dosens]);
    }

}
