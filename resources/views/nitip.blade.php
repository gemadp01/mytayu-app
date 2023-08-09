$table->id();
            // $table->foreignId('access_id');
            $table->string('nidn')->unique();
            $table->string('nama')->unique();
            $table->char('singkatan', 3)->unique()->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->integer('kuota_pembimbing')->nullable();
            $table->string('keilmuan')->nullable();
            $table->timestamps();

            public function index()
    {
        return view('dashboard.daftar-dosen.index', [
            'dosens' => Dosen::latest()->paginate(10),
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.daftar-dosen.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nidn' => 'required|max:10|unique:dosens',
            'nama' => 'required|regex:/^[A-Za-z0-9]+$/',
            'singkatan' => 'max:3',
            'nomor_telepon' => 'min:10|max:13',
            'kuota_pembimbing' => 'min:1',
            'keilmuan' => '',
        ]);

        Dosen::create($validatedData);

        return redirect('dashboard/daftar-dosen')->with('success', 'New Dosen has been added!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        Dosen::destroy($dosen->id);

        return redirect('dashboard/daftar-dosen')->with('success', 'Dosen has been deleted!');
        
    }
        });
    }


    // 'access_id' => 6,
    'nidn' => $this->faker->numberBetween(0, 1000000000),
    'nama' => $this->faker->name(),
    'singkatan' => $this->faker->lexify('???'),
    'nomor_telepon' => $this->faker->phoneNumber,
    'kuota_pembimbing' => $this->faker->randomNumber(2, true),
    'keilmuan' => $this->faker->sentence(2),