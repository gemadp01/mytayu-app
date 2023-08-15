<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.mahasiswa.index', [
            'mahasiswas' => Mahasiswa::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'npm' => 'required|max:8|unique:mahasiswas',
            'nama' => 'required',
            'email' => 'nullable',
            'kelas' => 'nullable',
            'prodi' => 'nullable',
        ]);

        $user = new User();

        $fullName = $validatedData['nama'];
        $nameParts = explode(" ", $fullName); // Pisahkan nama depan dan nama belakang menjadi array

        $firstName = $nameParts[0]; // Nama depan
        $firstTwoLetters = substr($firstName, 0, 2); // Ambil dua huruf pertama dari nama depan

        $user->level_user = 'mahasiswa';
        $user->status_user = false;
        $user->name = $validatedData['nama'];
        $user->username = $request->npm . Str::lower($firstTwoLetters);
        $user->password = Hash::make($validatedData['npm']);
        $user->save();

        $mahasiswa = Mahasiswa::create([
            'user_id' => $user->id,
            'level_user' => 'mahasiswa',
            'npm' => $validatedData['npm'],
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'kelas' => $validatedData['kelas'],
            'prodi' => $validatedData['prodi'],
        ]);

        return redirect('dashboard/mahasiswa')->with('success', 'New Mahasiswa has been added!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('dashboard.mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validatedData = $request->validate([
            'npm' => 'required|max:8',
            'nama' => 'required',
            'email' => 'nullable',
            'kelas' => 'nullable',
            'prodi' => 'nullable',
        ]);


        // Dosen::where('id', $dosen->id)->update($validatedData);
        $mahasiswa->update($validatedData);

        $fullName = $validatedData['nama'];
        $nameParts = explode(" ", $fullName); // Pisahkan nama depan dan nama belakang menjadi array

        $firstName = $nameParts[0]; // Nama depan
        $firstTwoLetters = substr($firstName, 0, 2); // Ambil dua huruf pertama dari nama depan

        $user = $mahasiswa->user;
        if ($user) {
            $user->name = $validatedData['nama'];
            $user->username = $validatedData['npm'] . Str::lower($firstTwoLetters);
            $user->password = Hash::make($validatedData['npm']);
            $user->save();
        }

        return redirect('dashboard/mahasiswa')->with('success', 'Mahasiswa has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $user = $mahasiswa->user; 
        if ($user) {
            $user->delete();
        }
        $mahasiswa->delete();

        return redirect('dashboard/mahasiswa')->with('success', 'Mahasiswa and associated User have been deleted!');
    }

    public function toggleStatus(Mahasiswa $mahasiswa)
    {
        $mahasiswa->toggleStatus();

        return redirect('dashboard/mahasiswa')->with('success', 'Status user berhasil diubah.');
    }

    public function import(Request $request) 
    {
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

        

        $header = array_shift($data); // Ambil baris pertama sebagai header

        // Cari indeks kolom yang sesuai dengan nama-nama header
        $npmIndex = array_search('NPM', $header);
        $namaIndex = array_search('Nama', $header);
        $kelasIndex = array_search('Kelas', $header);
        $emailIndex = array_search('Email', $header);
        $prodiIndex = array_search('Prodi', $header);

        foreach ($data as $row) {
            $user = new User();

            $fullName = $row[$namaIndex];
            $nameParts = explode(" ", $fullName);

            $firstName = $nameParts[0];
            $firstTwoLetters = substr($firstName, 0, 2);

            $user->level_user = 'mahasiswa';
            $user->status_user = false;
            $user->name = $row[$namaIndex];
            $user->username = $row[$npmIndex] . Str::lower($firstTwoLetters);
            $user->password = Hash::make($row[$npmIndex]);
            $user->save();

            Mahasiswa::create([
                'user_id' => $user->id,
                'level_user' => 'mahasiswa',
                'npm' => $row[$npmIndex],
                'nama' => $row[$namaIndex],
                'kelas' => $row[$kelasIndex],
                'email' => $row[$emailIndex],
                'prodi' => $row[$prodiIndex],
            ]);
        }

        if ($file->isValid()) {
            unlink($file->getPathname()); // Menghapus file dari direktori sementara
        }

        return redirect('dashboard/mahasiswa')->with('success', 'Data imported successfully.');
    }

    public function exportToPDF() 
    {
        $mahasiswas = Mahasiswa::all();

        $options = new Options();
        $options->set('defaultFont', 'Arial'); // Atur font default

        $dompdf = new Dompdf($options);

        $pdfView = view('dashboard.pdf.mahasiswa', compact('mahasiswas')); // Gunakan view PDF khusus
        $dompdf->loadHtml($pdfView);

        // (Opsional) Atur ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        return $dompdf->stream('mahasiswa_data.pdf');
    }

    public function exportToExcel() 
    {
        $mahasiswas = Mahasiswa::all();

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        // Menambahkan header ke worksheet
        $worksheet->setCellValue('A1', 'ID');
        $worksheet->setCellValue('B1', 'NPM');
        $worksheet->setCellValue('C1', 'Nama');
        $worksheet->setCellValue('D1', 'Email');
        $worksheet->setCellValue('E1', 'Kelas');
        $worksheet->setCellValue('F1', 'Prodi');

        // Menambahkan data ke worksheet
        $rowIndex = 2;
        foreach ($mahasiswas as $mahasiswa) {
            $worksheet->setCellValue('A' . $rowIndex, $mahasiswa->id);
            $worksheet->setCellValue('B' . $rowIndex, $mahasiswa->npm);
            $worksheet->setCellValue('C' . $rowIndex, $mahasiswa->nama);
            $worksheet->setCellValue('D' . $rowIndex, $mahasiswa->email);
            $worksheet->setCellValue('E' . $rowIndex, $mahasiswa->kelas);
            $worksheet->setCellValue('F' . $rowIndex, $mahasiswa->prodi);
            $rowIndex++;
        }

        $xlsxWriter = new Xlsx($spreadsheet);
        $xlsxWriter->save('mahasiswa_data.xlsx');

        return response()->download('mahasiswa_data.xlsx')->deleteFileAfterSend();
    }
}
