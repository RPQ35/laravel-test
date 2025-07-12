<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>


@if (session('role')=="siswa")
  <script>
      window.location.href = "/siswa";
  </script>
@elseif (session('role')=="Admin")
<script>
    window.location.href = "/admin";
</script>

@elseif (session('role')=="guru")
<script>
    window.location.href = "/guru";
</script>


@endif

@if (session('clearLocalStorage'))
<script>
    localStorage.clear();
</script>
@endif


  <body class="h-[99vh] w-full flex flex-row justify-center items-center">

    @if(session('error'))
    <p class=' w-56 h-24 bg-red-500 border-4 p-3 border-yellow-300 rounded-2xl fixed top-50 flex flex-row justify-center items-center font-bold text-lg text-center ' id="message" >{{ session('error') }}</p>
    

    <script>
        
        setTimeout(function(){
            document.getElementById('message').classList.remove('flex');
            document.getElementById('message').classList.add('hidden');
            }, 3000);
    </script>
    @endif
    
    <div class="border border-black rounded-lg m-4 lg:w-1/8 w-1/5 fixed h-10 flex flex-col items-center justify-center right-0  hover:bg-yellow-300 bg-amber-200 top-0">
      <button onclick="window.location.href='../';" class=" hover:bg-yellow-300 w-full">
        <h1 class="max-sm:ml-1 font-bold md:text-lg">Back</h1>
      </button>
    </div>

    <form method="POST" action="{{ route("login.in") }}" class="h-2/5 max-sm:w-7/9 max-md:w-3/5 max-lg:w-2/5 w-1/4 border border-black flex flex-col items-center justify-around rounded-2xl bg-orange-100">
        @csrf

        <h1 class="text-xl font-bold mt-2">
            Login User
            

        </h1>

        <div class="flex flex-col w-8/9">
            <label>username:</label>
            <input type="text" name="username" required autofocus  class="border border-black rounded-lg h-8 w-full font-medium px-5 bg-lime-50">
        </div>
        
    
        <div class="flex flex-col w-8/9">
            <label>Password:</label>
            <input type="password" name="password" required  class="border border-black rounded-lg h-8 w-full font-medium px-5 bg-lime-50">
        </div>
    
        <button type="submit" class="font-bold border align-middle border-black rounded-3xl h-10 w-24 px-5 hover:bg-green-600 mb-1 bg-lime-300">Login</button>
    </form>
    
  
  </body>
</html>