<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    window.location.href = "/guru}";
</script>

@endif


  <body class="flex flex-col  items-center w-full h-[99.8vh] bg-lime-50">
    <header class="flex flex-col justify-center max-md:items-end pr-2 items-center w-full h-1/8 ">
        <button class="fixed top-5 left-5 border border-black p-4 rounded-sm  font-semibold font-mono  hover:bg-yellow-300" onclick="window.location.href='/login';">Login</button>
        <h1 class="flex flex-col justify-center items-center border border-black rounded-2xl h-1/2 w-2/5 max-md:w-3/5 text-xl font-bold max-md:text-lg">
            Laman perizinan siswa
        </h1>
    </header>

    <main class="flex flex-col justify-center items-center w-full h-6/8 ">

        @if(session('success'))
        <p class='w-64 h-12 bg-lime-500 border-4 border-yellow-300 rounded-2xl fixed top-50 flex flex-row justify-center items-center font-bold text-lg  ' id="message" >{{ session('success') }}</p>
        
        <script>
            
            setTimeout(function(){
                document.getElementById('message').classList.remove('flex');
                document.getElementById('message').classList.add('hidden');
                }, 3000);
        </script>
        @endif
        

            <form action="{{ route('senter') }}" method="POST"  enctype="multipart/form-data" class="flex flex-col gap-y-1 items-center w-2/3 h-6/8 border border-black max-sm:w-7/8 rounded-2xl pt-13  bg-orange-100">
                @csrf
              
                <div class="flex flex-col w-5/6 h-2/9 relative ">
                    <label for="nama_siswa" class="font-semibold font-serif">Nama siswa</label>
                    <input type="text" name="nama_siswa" class="border border-black rounded-3xl h-10 w-full font-medium px-5 bg-lime-50" required autocomplete="off" id="nama_in"  >
                    <div id="suggestions" class="absolute bg-white shadow-lg z-50 w-54 max-h-40 overflow-auto text-sm font-semibold rounded-sm m-15 border border-black " style="display:none;"></div>

                </div>
                
                <div class="flex flex-col w-5/6 h-2/9">
                    <label for="Kelas" class="font-semibold font-serif"   >kelas</label>
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

                <div class="flex flex-col w-5/6 h-2/9">
                    <label for="jenis_izin" class="font-semibold font-serif">jenis izin</label>
                    <select name="jenis_izin" id="" class="border border-black rounded-3xl h-10 w-full px-5 font-semibold bg-lime-50 " required>
                        <option value="sakit" class="font-medium">sakit</option>
                        <option value="dispen" class="font-medium">dispen</option>
                        <option value="other" class="font-medium">other</option>
                    </select>
                </div>
                <div class="flex flex-col w-5/6 h-2/9">
                    <label for="foto_bukti" class="font-semibold font-serif">foto bukti </label>
                    <input type="file" name="foto_bukti" id="" class="border border-black rounded-3xl h-10 w-54 font-medium px-2 py-1 cursor-pointer bg-amber-200 text-center hover:bg-yellow-300" required>
                </div>
                <button type="submit" class="font-semibold font-serif border align-middle border-black rounded-3xl h-10 w-24 px-5 hover:border-3 hover:bg-green-600 mb-1 bg-lime-300">submit</button>
            </form>
            
    </main>
  </body>
</html>

<script>
  const input = document.getElementById('nama_in');
  const suggestionsBox = document.getElementById('suggestions');
  let timeout = null;

  input.addEventListener('input', function () {
      const query = this.value;
      clearTimeout(timeout);

      timeout = setTimeout(() => {
          if (query.length < 1) {
              suggestionsBox.style.display = 'none';
              return;
          }

          fetch(`/user?q=${encodeURIComponent(query)}`)
              .then(res => res.json())
              .then(data => {
                  suggestionsBox.innerHTML = '';

                  if (data.length > 0) {
                      data.forEach(name => {
                          const div = document.createElement('li');
                          div.textContent = name;
                          div.className = 'p-2 hover:bg-gray-200 cursor-pointer';

                          div.onclick = function () {
                              input.value = name;
                              suggestionsBox.style.display = 'none';
                          };

                          suggestionsBox.appendChild(div);
                      });
                      suggestionsBox.style.display = 'block';
                  } else {
                      suggestionsBox.style.display = 'none';
                  }
              })
              .catch(error => {
                  console.error('Search error:', error);
                  suggestionsBox.style.display = 'none';
              });
      }, 300); // wait 300ms after user stops typing
  });

  // Optional: hide suggestions if input loses focus
  input.addEventListener('blur', function () {
      setTimeout(() => {
          suggestionsBox.style.display = 'none';
      }, 200);
  });
</script>


<script>
    // console.log(document.querySelector('meta[name="csrf-token"]').content);
    // ===================================================================================

    function sentall(){
        const value = selectElement.dataset.value;
  
        fetch(`/user`, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ nama_siswa: value })
        })
        .then(res => res.json())
        .then(data => {

        })
        .catch(err => {
            console.error('Error:', err);
            alert('tidak ada di data');
        });
        }



  function pindah(selectElement){
    const isi=selectElement.dataset.value;
    document.getElementById("nama_in").value=isi;

  }

  function buka(){
    document.getElementById("opsi-1").classList.remove("hidden");
    document.getElementById("opsi-2").classList.remove("hidden");
    document.getElementById("opsi-3").classList.remove("hidden");
  }
  function tutup(){
    setTimeout(() => {
    document.getElementById("opsi-1").classList.add("hidden");
    document.getElementById("opsi-2").classList.add("hidden");
    document.getElementById("opsi-3").classList.add("hidden");
  }, 200); 
  }
//   ==============================================================



      </script>
  
  