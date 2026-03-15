<div class="flex flex-col gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Nome</label>
        <input type="text" name="nome" value="{{ old('nome', $tecnico->nome ?? '') }}"
            class="mt-1 w-full border rounded px-3 py-2 @error('nome') border-red-500 @enderror">
        @error('nome') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">E-mail</label>
        <input type="email" name="email" value="{{ old('email', $tecnico->email ?? '') }}"
            class="mt-1 w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror">
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Especialidade</label>
        <input type="text" name="especialidade" value="{{ old('especialidade', $tecnico->especialidade ?? '') }}"
            class="mt-1 w-full border rounded px-3 py-2 @error('especialidade') border-red-500 @enderror">
        @error('especialidade') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>
</div>
