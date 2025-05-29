<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Gateway;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class GatewayCrud extends Component
{
    use WithFileUploads;

    public $gateways, $nome, $url, $private_key, $public_key, $tax, $logo, $logoPreview, $gateway_id;
    public $isEdit = false;

    protected $rules = [
        'nome' => 'required|string|max:255',
        'url' => 'required',
        'tax' => 'nullable|numeric|min:0',
        'private_key' => 'nullable|string',
        'public_key' => 'nullable|string',
    ];

    public function render()
    {
        $this->gateways = Gateway::latest()->get();
        return view('livewire.gateway-crud'); 
    }

    public function resetFields()
    {
        $this->nome = $this->url = $this->private_key = $this->public_key = $this->tax = '';
        $this->logo = null;
        $this->logoPreview = null;
        $this->gateway_id = null;
        $this->isEdit = false;
    }

    public function updatedLogo()
    {
        $this->logoPreview = $this->logo->temporaryUrl();
    }

    public function save()
    {
        Log::info('Inicio Salvar Gateway');
        $this->validate();

        $logoPath = $this->logo ? $this->logo->store('logos', 'public') : null;
        //$logoPath = 'teste';

        $gateway = Gateway::create([
            'nome' => $this->nome,
            'url' => $this->url,
            'private_key' => $this->private_key,
            'public_key' => $this->public_key,
            'tax' => $this->tax,
            'logo' => $logoPath,
        ]);

        Log::info('Gateway Salvo',[$gateway]);

        $this->resetFields();
        session()->flash('message', 'Gateway criado com sucesso!');

        // $this->dispatchBrowserEvent('close-modal-gateway');
        $this->dispatch('close-modal-gateway');
    }

    public function edit($id)
    {
        $gateway = Gateway::findOrFail($id);
        $this->gateway_id = $gateway->id;
        $this->nome = $gateway->nome;
        $this->url = $gateway->url;
        $this->private_key = $gateway->private_key;
        $this->public_key = $gateway->public_key;
        $this->tax = $gateway->tax;
        $this->logoPreview = asset('storage/' . $gateway->logo);
        $this->isEdit = true;

        Log::info('Editar Gateway',[$gateway]);

        $this->dispatch('close-modal-gateway');
    }

    public function update()
    {
        $this->validate();

        $gateway = Gateway::find($this->gateway_id);

        if ($this->logo && is_object($this->logo)) {
            $logoPath = $this->logo->store('logos', 'public');
        } else {
            $logoPath = $gateway->logo;
        }

        $gateway->update([
            'nome' => $this->nome,
            'url' => $this->url,
            'private_key' => $this->private_key,
            'public_key' => $this->public_key,
            'tax' => $this->tax,
            'logo' => $logoPath,
        ]);

        Log::info('Update Gateway',[$gateway]);

        $this->resetFields();
        session()->flash('message', 'Gateway atualizado com sucesso!');

        $this->dispatch('close-modal-gateway');
    }


    public function delete($id)
    {
        $gateway = Gateway::destroy($id);
        Log::info('Deletey Gateway',[$gateway]);
        session()->flash('message', 'Gateway removido!');
    }
}
