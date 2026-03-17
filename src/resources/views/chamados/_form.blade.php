<div class="flex flex-col gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Título</label>
        <input type="text" name="titulo" value="{{ old('titulo', $chamado->titulo ?? '') }}"
            class="mt-1 w-full border rounded px-3 py-2 @error('titulo') border-red-500 @enderror">
        @error('titulo') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Descrição</label>
        <textarea name="descricao" rows="4"
            class="mt-1 w-full border rounded px-3 py-2 @error('descricao') border-red-500 @enderror">{{ old('descricao', $chamado->descricao ?? '') }}</textarea>
        @error('descricao') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Prioridade</label>
        <select name="prioridade" class="mt-1 w-full border rounded px-3 py-2 @error('prioridade') border-red-500 @enderror">
            @foreach(['baixa', 'média', 'alta'] as $p)
                <option value="{{ $p }}" {{ old('prioridade', $chamado->prioridade ?? '') == $p ? 'selected' : '' }}>
                    {{ ucfirst($p) }}
                </option>
            @endforeach
        </select>
        @error('prioridade') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" class="mt-1 w-full border rounded px-3 py-2 @error('status') border-red-500 @enderror">
            @php
                $statuses = ['aberto', 'em_atendimento', 'resolvido', 'fechado'];
                $current = old('status', $chamado->status ?? 'aberto');
            @endphp

            @if(isset($chamado))
                @foreach($statuses as $s)
                    @if($s === 'resolvido' && ! (Auth::check() && Auth::user()->can('resolve', $chamado)))
                        @continue
                    @endif

                    @if($s === 'fechado' && ! (Auth::check() && Auth::user()->can('close', $chamado)))
                        @continue
                    @endif

                    <option value="{{ $s }}" {{ $current == $s ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($s)) }}</option>
                @endforeach
            @else
                <option value="aberto" {{ $current == 'aberto' ? 'selected' : '' }}>Aberto</option>
                <option value="em_atendimento" {{ $current == 'em_atendimento' ? 'selected' : '' }}>Em atendimento</option>
                @if(Auth::check() && in_array(Auth::user()->role ?? 'user', ['tecnico','admin']))
                    <option value="resolvido" {{ $current == 'resolvido' ? 'selected' : '' }}>Resolvido</option>
                @endif
            @endif
        </select>
        @error('status') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Data de Abertura</label>
        <input type="date" name="data_abertura" value="{{ old('data_abertura', isset($chamado) ? $chamado->data_abertura : date('Y-m-d')) }}"
            class="mt-1 w-full border rounded px-3 py-2 @error('data_abertura') border-red-500 @enderror">
        @error('data_abertura') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Técnico</label>
        <select name="tecnico_id" class="mt-1 w-full border rounded px-3 py-2 @error('tecnico_id') border-red-500 @enderror">
            <option value="">Selecione...</option>
            @foreach($tecnicos as $tecnico)
                <option value="{{ $tecnico->id }}" {{ old('tecnico_id', $chamado->tecnico_id ?? '') == $tecnico->id ? 'selected' : '' }}>
                    {{ $tecnico->nome }}
                </option>
            @endforeach
        </select>
        @error('tecnico_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Categoria</label>
        <select name="categoria_id" class="mt-1 w-full border rounded px-3 py-2 @error('categoria_id') border-red-500 @enderror">
            <option value="">Selecione...</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('categoria_id', $chamado->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
        @error('categoria_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>
</div>
