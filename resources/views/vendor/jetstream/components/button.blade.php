<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-400 active:bg-primary-600 focus:outline-none focus:border-primary-600 focus:shadow-outline-primary disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
