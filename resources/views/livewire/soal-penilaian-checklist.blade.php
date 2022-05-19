<div>
   
  @if(isset($selectedPertanyaan))
    <div class="form-group">
      <label>CHECKED PERTANYAAN</label>
      <table id="table_id" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>Delete</th>
          <th>Pertanyaan</th>
          <th>Checked</th>
        </tr>
        </thead>
        <tbody>
        @if (isset($soalPenilaianAll))
            @foreach ($soalPenilaianAll as $pertanyaan)
            <tr>
              <td>
                  <button type="button" class="btn btn-danger" wire:click="deselectPertanyaan({{ $pertanyaan->id }})"><i class="fas fa-minus-circle"></i></button>
              </td>
              <td>{{ $pertanyaan->pertanyaan }}</td>
              <td><input class="form-check-input" type="checkbox" name="soal_penilaians[]" value="{{ $pertanyaan->id }}" 
                id="check-{{ $pertanyaan->id }}" }} checked></td>
            </tr>
            @endforeach
        @endif
        
        </tbody>
      </table>
    </div>
  @endif
    <div class="card">
        <div class="card-header">
            <h3>Tambah Pertanyaan</h3>
        </div>
        <div class="card-body">
          {{-- @foreach ($selectedPertanyaan as $item)
              {{ $item  }}
          @endforeach --}}
                
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="q" wire:model="q"
                               placeholder="cari berdasarkan pertanyaan">
                    </div>
          <table id="table_id" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Choose</th>
              <th>Pertanyaan</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($soal_penilaians as $pertanyaan)
              <tr>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" wire:model="selectedPertanyaan" type="checkbox" name="soal_penilaians[]" value="{{ $pertanyaan->id }}" 
                               id="check-{{ $pertanyaan->id }}" }}>
                    </div>
                </td>
                <td>{{ $pertanyaan->pertanyaan }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
         
          <div style="text-align: center">
            {{$soal_penilaians->links()}}
          </div>
        </div>
    </div>
</div>
