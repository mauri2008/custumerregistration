// instanciado a buttom salvar do modal 
const btnSave = document.querySelector('#btn-save');

btnSave.addEventListener('click',()=>{
    handleSave();
})

// função responsavel por enviar requição de salvamento dos dados
const handleSave = async ()=>{
    const clientId = document.querySelector('#client_id');
    const clientName = document.querySelector('#client_name');
    const subtitle = document.querySelector('#emailHelp');
    const formclient = document.getElementById('form_client')
    

    if(clientName.value == ''){
        alert(clientName, subtitle)
        return
    }else{
         alert(clientName, subtitle)
    }


    let datarest  = await handleRequest('sis/client','POST',new FormData(formclient))

    if(datarest){
        closeOneModal('modaldefault')
        notification('success', 'Cliente inserido com sucesso');
        setTimeout(()=>{
        document.location.reload() 
        },500) 
    }
    

}

// função resposavel por fechar modal 
// necessario por não esta usando a biblioteca JQUERY
function closeOneModal(modalId) {

    // get modal
    const modal = document.getElementById(modalId);
    const body = document.querySelector('body')

    // change state like in hidden modal
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
    modal.setAttribute('style', 'display: none');
    modal.removeAttribute('role')
    modal.removeAttribute('aria-modal')

    body.classList.remove('modal-open');
    body.removeAttribute('style');

     // get modal backdrop
     const modalBackdrops = document.getElementsByClassName('modal-backdrop');

     // remove opened modal backdrop
      document.body.removeChild(modalBackdrops[0]);
}

// função resposavel por preencher o modal com os dados a serem editados
const handleEdit = (id, name)=>{
    const inputId = document.querySelector('#client_id')
    const inputName = document.querySelector('#client_name')

    inputId.value = id;
    inputName.value = name;

}

// funcção responsavel por requisitar a remoção de um dado
const handleRemove = async (id)=>{
    if(confirm('Deseja realmente remover este cliente?')){
        const requestDelete = await handleRequest(`sis/client?client_id=${id}`,'DELETE','');
    
        if(requestDelete){
            notification('success', 'Cliente removido com sucesso');
            setTimeout(()=>{
               document.location.reload() 
            },500) 
        }

    }
}

// função responsavel por fazer todas as requisições
const handleRequest = async (url, method, data)=>{
    // get URL BASE
    const url_base = document.getElementById('base_url').getAttribute('data-url');
    try{
    const request = await fetch(`${url_base}/${url}`,{
        method:method,
        headers:[],
        body:data
    })
    const status = request.status;
    if(status === 200){
        const json = await request.json()
        return json;
    }else{
        const error = await request.json();
        notification('error',error.menssage);
        return false;
    }
    
    }catch(err){
        console.log(err);
        return false
    }
}

// função reponsavel por  estilizar o input modal quando não esta preenchido
const alert = (clientName, subtitle)=>{

    if(clientName.value == '')
    {
        clientName.classList.add('border');
        clientName.classList.add('text-danger');
        clientName.classList.add('border-3');
        clientName.classList.add('border-danger');
        subtitle.classList.remove('d-none');
    }else{
        clientName.classList.remove('border');
        clientName.classList.remove('text-danger');
        clientName.classList.remove('border-3');
        clientName.classList.remove('border-danger');
        subtitle.classList.add('d-none');
    }
}

// função reponsavel por gerar as notificações toasts
const notification = (type = null, msg='') =>{

    const toastLiveExample = document.getElementById('liveToast')
    const toast = new bootstrap.Toast(toastLiveExample)

    if(toastLiveExample.classList.contains('bg-success'))
        toastLiveExample.classList.remove('bg-success');

    if(toastLiveExample.classList.contains('bg-danger'))
        toastLiveExample.classList.remove('bg-danger');


    const elementMsg = document.querySelector('#msg-notification');

    switch(type)
    {
        case 'success':
            elementMsg.innerHTML = msg;
            toastLiveExample.classList.add('bg-success');
            break;
        case 'error':
            toastLiveExample.classList.add('bg-danger');
            elementMsg.innerHTML = msg;
            break;
    }

    toast.show()
}