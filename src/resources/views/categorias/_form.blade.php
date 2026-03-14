<div class="flex flex-col gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Nome</label>
        <input type="text" name="nome" value="{{ old('nome', $categoria->nome ?? '') }}"
            class="mt-1 w-full border rounded px-3 py-2 @error('nome') border-red-500 @enderror">
        @error('nome') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Horas (SLA)</label>
        <input type="number" name="horas" value="{{ old('horas', $categoria->horas ?? '') }}" min="1"
            class="mt-1 w-full border rounded px-3 py-2 @error('horas') border-red-500 @enderror">
        @error('horas') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>
</div>
