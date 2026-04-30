@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-xl shadow-sm transition-all']) }}>
