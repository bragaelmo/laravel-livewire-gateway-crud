// resources/js/gateway.js

window.openModalGateway = () => {
    console.log('abrir modal');
    const modal = new bootstrap.Modal(document.getElementById('gatewayModal'));
    modal.show();
}

window.closeModalGateway = () => {
    console.log('fechar modal');
    const modal = bootstrap.Modal.getInstance(document.getElementById('gatewayModal'));
    if (modal) {
        modal.hide();
    }
}

window.confirmAndDelete = function (componentId, gatewayId) {
    if (confirm('Tem certeza que deseja excluir?')) {
        Livewire.find(componentId).delete(gatewayId);
    }
};

window.addEventListener('open-modal-gateway', () => openModalGateway());
window.addEventListener('close-modal-gateway', () => closeModalGateway());

Livewire.on('close-modal-gateway', () => closeModalGateway());