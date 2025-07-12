<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

  </head>

  


  @if (session('role')!=="guru")
  <script>
      window.location.href = "{{ url('/logout') }}";
  </script>
@endif


  <body class="flex flex-col justify-between  items-center w-full h-[99.8vh]">
    
    <header class="w-full h-2/8">
        <div class="border border-black rounded-lg m-4 lg:w-2/7 w-2/3 fixed h-10 flex flex-col items-center justify-center">
          <h1 class="max-sm:ml-1 font-bold md:text-lg">
              List pemberitahuan / permohonan izin
          </h1>
        </div>
        <div class="border border-black rounded-lg m-4 lg:w-1/8 w-1/5 fixed h-10 flex flex-col items-center justify-center right-0 hover:bg-yellow-300 bg-amber-200">
          <button onclick="window.location.href='/logout';" class="hover:bg-yellow-300 bg-amber-200 w-full">
            <h1 class="max-sm:ml-1 font-bold md:text-lg font-mono">Log out</h1>
          </button>
        </div>
    </header>


    <main class="h-5/6 w-full flex flex-col lg:flex-row justify-between lg:justify-around items-center lg:items-start">
      
      <table class=" table  rounded-lg md:w-4/6 w-9/10 mt-30">
        <thead class="bg-slate-300">
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody class=" border border-black ">
          @foreach($data as $item)
          <tr class=" border  border-t-black border-b-black h-15 border-l-white border-r-white ">
              <td class=" text-center font-semibold">{{ $item->nama_siswa }}</td>
              <td class=" text-center font-semibold">{{ $item->kelas }}</td>
              <td class=" text-center font-semibold">{{ $item->jenis_izin }}</td>
              <td class="h-full p-1">
                <img src="{{ route('admin.image', $item->id) }}" class="max-w-20 max-h-20 flex flex-row justify-center items-center"  alt="bukti izin">
              </td>
              <td class=" text-center font-semibold">
                <select onchange="updateApproval(this)" data-id="{{ $item->id }}">
                <option {{ $item->aprooval == 0 ? 'selected' : '' }} value="0">not aprooved</option>
                <option {{ $item->aprooval == 1 ? 'selected' : '' }} value="1">aprooved</option>
 
              </select></td>
          </tr>
      @endforeach
        </tbody>
      </table>

  </body>
  <script>

function shouldRunFunction(intervalMinutes) {
            const lastRunKey = 'myLastRunTime'; // localStorage key
            const now = new Date();
            const nowMs = now.getTime();
        
            const saved = localStorage.getItem(lastRunKey);
        
            if (!saved) {
                // No previous record, store now and run the function
                localStorage.setItem(lastRunKey, nowMs);
                return true;
            }
        
            const lastRunMs = parseInt(saved);
            const diffMs = nowMs - lastRunMs;
        
            const minutesPassed = diffMs / (1000 * 60);
        
            console.log(`Minutes since last run: ${minutesPassed.toFixed(2)}`);
        
            if (minutesPassed >= intervalMinutes) {
                // Update timestamp
                localStorage.clear();
                return true;
            }
        
            return false;
        }
        
        // Example usage:
//         if (shouldRunFunction(20)) {
//             window.location.href='/logout'
//             // yourFunction();
//         } else {
// // nothing
//         }



  function updateApproval(selectElement) {
    const id = selectElement.dataset.id;
    const value = selectElement.value;
  
    fetch(`/guru/update-approval/${id}
    `, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ aprooval: value })
    })
    .then(res => res.json())
    .then(data => {
        console.log('Updated:', data);
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Failed to update');
    });
  }
  </script>
</html>