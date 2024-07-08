@if (session()->get('status_id') == 99)
<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="./" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
		<a href="{{ url('login/logout') }}">
			<button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
				<i class="fas fa-plus mr-3"></i>Logout
			</button>
		</a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('user.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item"> <!-- active-nav-link -->
			<i class="far fa-user mr-3"></i>
            User
        </a>
        <a href="{{ route('artwork.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-crop-alt mr-3"></i>
            Artworks
        </a>
        <a href="{{ route('artist.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-paint-brush mr-3"></i>
            Artists
        </a>
		<a href="{{ route('exhibition.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-table mr-3"></i>
            Exhibitions
        </a>
        <a href="{{ route('ticket.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-wallet mr-3"></i>
            tickets
        </a>
		<a href="{{ route('status.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-align-left mr-3"></i>
            Status
        </a>
		<!--
		<a href="{{ route('goods.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-align-left mr-3"></i>
            Goods
        </a>
		-->
    </nav>
</aside>
@endif	