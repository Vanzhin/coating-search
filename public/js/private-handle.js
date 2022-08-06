function PrivateHandle(compilation) {
    const id = compilation.getAttribute('data-comp');
    compilation.style.pointerEvents='none';
    compilation.firstElementChild.remove();
    compilation.innerHTML = '<i class="fa-regular fa-clock"></i>';
    privateSend('/compilations/private/' + id).then((result) => {
        compilation.firstElementChild.remove();
        if(result.is_private){
            compilation.innerHTML = '<i class="fa-solid fa-lock"></i>';
        } else{
            compilation.innerHTML = '<i class="fa-solid fa-lock-open"></i>';
        }
        compilation.style.pointerEvents='auto';
    })

}

async function privateSend(url)
{
    let response = await fetch(url, {
        method: 'GET',
    });
    return await response.json();
}

