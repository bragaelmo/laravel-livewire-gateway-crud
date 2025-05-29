   <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Gateways</h2>

        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button class="btn btn-primary" onclick="openModalGateway()">Novo Gateway</button>

        {{-- V.10 PRIMEIRA VERSÃO DO FORM SEM MODAL.
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" enctype="multipart/form-data" class="space-y-4 mb-6">
            <input type="text" wire:model.defer="nome" placeholder="Nome" class="w-full border p-2">
            <input type="text" wire:model.defer="url" placeholder="URL" class="w-full border p-2">
            <input type="text" wire:model.defer="private_key" placeholder="Chave Privada" class="w-full border p-2">
            <input type="text" wire:model.defer="public_key" placeholder="Chave Pública" class="w-full border p-2">
            <input type="number" wire:model.defer="tax" step="0.01" placeholder="Taxa (%)" class="w-full border p-2">

            <input type="file" wire:model="logo" class="w-full border p-2">
            @if ($logoPreview)
                <img src="{{ $logoPreview }}" alt="Prévia" class="w-24 h-24 object-cover mt-2">
            @endif

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $isEdit ? 'Atualizar' : 'Cadastrar' }}
            </button>
        </form>  --}}

      
        
        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Logo</th>
                    <th class="border p-2">Nome</th>
                    <th class="border p-2">URL</th>
                    <th class="border p-2">Taxa</th>
                    <th class="border p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gateways as $g)
                    <tr>
                        <td class="border p-2">
                            <img src="{{ asset('storage/' . $g->logo) }}" class="w-12 h-12 object-contain" style="width: 200px;">
                        </td>
                        <td class="border p-2" style="width: 300px;">{{ $g->nome }}</td>
                        <td class="border p-2" style="width: 300px;">{{ $g->url }}</td>
                        <td class="border p-2" style="width: 300px;">{{ $g->tax }}%</td>
                        <td class="border p-2" style="width: 300px;">
                            <!--<button wire:click="edit({{ $g->id }})" class="btn btn-warning">Editar</button>-->
                            <button class="btn btn-sm btn-warning"
                                onclick="openModalGateway()"
                                wire:click="edit({{ $g->id }})">
                                Editar
                            </button>
                        <button onclick="confirmAndDelete('{{ $this->getId() }}', {{ $g->id }})"
                                class="btn btn-danger">
                            Excluir
                        </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

         <!-- Modal Bootstrap -->
        <div wire:ignore.self class="modal fade" id="gatewayModal" tabindex="-1" aria-labelledby="gatewayModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" enctype="multipart/form-data" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="gatewayModalLabel">
                            {{ $isEdit ? 'Editar Gateway' : 'Cadastrar Gateway' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-2">
                            <input type="text" wire:model.defer="nome" class="form-control" placeholder="Nome">
                            @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-2">
                            <input type="text" wire:model.defer="url" class="form-control" placeholder="URL">
                            @error('url') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-2">
                            <input type="text" wire:model.defer="private_key" class="form-control" placeholder="Chave Privada">
                        </div>
                        <div class="mb-2">
                            <input type="text" wire:model.defer="public_key" class="form-control" placeholder="Chave Pública">
                        </div>
                        <div class="mb-2">
                            <input type="number" wire:model.defer="tax" step="0.01" class="form-control" placeholder="Taxa (%)">
                            @error('tax') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-2">
                            <input type="file" wire:model="logo" class="form-control">
                            @error('logo') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        @if ($logoPreview)
                            <img src="{{ $logoPreview }}" class="img-fluid mt-2 rounded" width="100">
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            {{ $isEdit ? 'Atualizar' : 'Cadastrar' }}
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
            
    </div>
   

<script>
    window.addEventListener('open-modal-gateway', () => {
        openModalGateway();
    });

    window.addEventListener('close-modal-gateway', () => {
        closeModalGateway();
    });

</script>