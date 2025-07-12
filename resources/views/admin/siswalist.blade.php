<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>



  @if (session('role')!=="admin")
  <script>
      window.location.href = "{{ url('/logout') }}";
  </script>
@endif



  <body class="flex flex-col justify-between  items-center w-full h-[99.8vh]">
    
    <header class="w-full h-2/8">
        <div class="border border-black rounded-lg m-4 lg:w-1/5 w-1/3  fixed h-10 flex flex-col items-center justify-center">
          <h1 class="max-sm:ml-1 font-bold md:text-lg">
              Laman tabel siswa
          </h1>
        </div>
        <div class="border border-black rounded-lg m-4 lg:w-1/8 w-1/5 fixed h-10 flex flex-col items-center justify-center right-0 hover:bg-yellow-300 bg-amber-200  ">
          <button onclick="window.location.href='/admin';" class="  w-full">
            <h1 class="max-sm:ml-1 font-bold md:text-lg font-mono">back</h1>
          </button>
        </div>
    </header>


    <main class="h-5/6 w-full flex flex-col lg:flex-row justify-between lg:justify-around items-center lg:items-start">
      
      <table class=" table border border-black rounded-lg md:w-4/6 w-9/10">
        <thead class="bg-slate-300">
          <tr>
            <th class="border border-black">nama siswa</th>
            <th class="border border-black">kelas</th>
            
            <th class="border border-black">remove</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($siswalist as $item)
          
          <tr>
            <td class="font-medium text-center">{{ $item->nama_siswa }}</td>
            
            <td class="font-medium text-center">
          {{ $item->kelas }}
            </td>
            <td class="max-h-5  flex flex-row justify-center items-center font-medium text-center ">
              
            <form method="POST" action="{{ route('admin.siswa.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?');">
              @csrf
              @method('DELETE')
              <button class=" font-medium text-center flex flex-row justify-center items-center max-h-5 max-w-5 mt-0.5 cursor-pointer hover:bg-red-800 rounded-2xl">
                <img class="max-h-5 max-w-5 " src="{{ asset('image\delete.png') }}" alt="">
              </button>
            </form>
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <form action="{{ route('admin.siswa.made') }}" method="post" class="border border-black rounded-xl max-lg:w-9/10 w-1/6 flex flex-col lg:justify-around items-center h-3/6 max-lg:h-2/6 mb-2 bg-orange-100" >
        @csrf
        <div>
          <h1 class="font-semibold lg:text-lg text-center">tambah user / admin baru</h1>
        </div>
        <div class="w-8/9 flex flex-row lg:flex-col max-lg:justify-around">
          <label for="nama_siswa">nama_siswa</label>
          <input type="text" name="nama_siswa" id="" class="border border-black rounded-2xl pl-3 bg-lime-50">
        </div>
        <div class="w-8/9 flex flex-row lg:flex-col max-lg:justify-around">
          <label for="kelas">kelas</label>
          <select name="kelas" id="" class="border border-black rounded-3xl h-10 w-full px-5 font-semibold bg-lime-50 " required  >
            <option value="10pplg" class="font-medium">10pplg</option>
            <option value="10dkv" class="font-medium">10dkv</option>
            <option value="10mplb" class="font-medium">10mplb</option>
            <option value="10tjkt" class="font-medium">10tjkt</option>
            <option value="11pplg" class="font-medium">11pplg</option>
            <option value="11dkv" class="font-medium">11dkv</option>
            <option value="11mplb" class="font-medium">11mplb</option>
            <option value="11tjkt" class="font-medium">11tjkt</option>
            <option value="12pplg" class="font-medium">12pplg</option>
            <option value="12dkv" class="font-medium">12dkv</option>
            <option value="12mplb" class="font-medium">12mplb</option>
            <option value="12tjkt" class="font-medium">12tjkt</option>
        </select>
        </div>
        <button class="border border-black rounded-sm  w-3/6 hover:bg-green-600 mb-1 bg-lime-300">add</button>
      </form>

    </main>

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


</script>
      
</html>
