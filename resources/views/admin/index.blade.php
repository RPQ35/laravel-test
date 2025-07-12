<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
</head>




@if (session('role')!=="admin")
<script>
    window.location.href = "{{ url('/logout') }}";
</script>
@endif


<body class="w-full h-[98vh] overflow-hidden flex flex-col items-center justify-around">

    <header class="w-full h-2/8">
        <div class="border border-black rounded-lg m-4 lg:w-1/5 w-1/3  fixed h-10 flex flex-col items-center justify-center">
          <h1 class="max-sm:ml-1 font-bold md:text-lg">
              Laman tabel akses
          </h1>
        </div>
        <div class="border border-black rounded-lg m-4 lg:w-1/8 w-1/5 fixed h-10 flex flex-col items-center justify-center right-0 hover:bg-yellow-300 bg-amber-200  ">
          <button onclick="window.location.href='/logout';" class="  w-full">
            <h1 class="max-sm:ml-1 font-bold md:text-lg font-mono">Log out</h1>
          </button>
        </div>
    </header>

    <main class="max-lg:w-8/9 w-7/9 h-6/8  bg-orange-100 border border-black flex flex-col lg:flex-row justify-around items-center" >
        <a href="/admin/siswa" class="lg:w-2/6 w-2/4 bg-slate-400 lg:h-2/4 h-1/4 font-bold text-2xl font-mono hover:bg-amber-300 flex flex-row justify-center items-center border-4 border-slate-600  rounded-xl"><p>list siswa</p></a>
        <a href="/admin/acces" class="lg:w-2/6 w-2/4 bg-slate-400 lg:h-2/4 h-1/4 font-bold text-2xl font-mono hover:bg-amber-300 flex flex-row justify-center items-center border-4 border-slate-600  rounded-xl">list akses</a>
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