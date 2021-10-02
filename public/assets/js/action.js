
const btnSave = document.querySelector('#btn-save');

btnSave.addEventListener('click',()=>{
    handleSave();
})

const handleSave = async ()=>{
    const clientId = document.querySelector('#btn-save');
    const clientName = document.querySelector('#client_name');
    const subtitle = document.querySelector('#emailHelp');
    const formclient = document.getElementById('form_client')
    

    if(clientName.value == ''){
        alert(clientName, subtitle)
        return
    }else{
         alert(clientName, subtitle)
    }

    if(clientId.value == ''){

    let datarest  = await handleRequest('sis/client','POST',new FormData(formclient))

    if(datarest){
        closeOneModal('modaldefault')
        notification('success', 'Cliente inserido com sucesso');
        setTimeout(()=>{
           document.location.reload() 
        },500) 
    }

    }

}
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