<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-iaspig-orange border border-transparent rounded-full font-bold text-sm text-white uppercase tracking-widest hover:bg-iaspig-brown focus:bg-iaspig-brown active:bg-iaspig-brown focus:outline-none focus:ring-2 focus:ring-iaspig-orange focus:ring-offset-2 transition ease-in-out duration-300 shadow-lg shadow-iaspig-orange/20']) }}>
    {{ $slot }}
</button>
