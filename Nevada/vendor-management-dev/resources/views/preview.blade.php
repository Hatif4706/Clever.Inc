<x-layout title="Document preview">

    <a href="{{ asset($src) }}" class="btn fixed top-4 right-4 z-10" title="Download">
        <x-icons.arrow-down-tray /> Download
    </a>

    <div id="container"></div>

    <!--optional polyfill for promise-->
    <script src="https://unpkg.com/promise-polyfill/dist/polyfill.min.js"></script>
    <!--lib uses jszip-->
    <script src="https://unpkg.com/jszip/dist/jszip.min.js"></script>
    <script src="{{ asset('js/docx-preview.min.js') }}"></script>

    <script>
        const docData = fetch('{{ asset($src) }}').then(res => res.blob());

        docx.renderAsync(docData, document.getElementById("container"));
    </script>

</x-layout>
