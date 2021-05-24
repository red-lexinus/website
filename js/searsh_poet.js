document.querySelector('#search_poet').oninput = function () {
    let need_poet = this.value.trim();
    let poets = document.querySelectorAll('.poet')
    for (let i = 0; i < poets.length; ++i) {
        let poet = poets[i]
        let card = poet.querySelector('.card')
        let cord_body = card.querySelector('.card-body')
        let  p = cord_body.querySelector('p').innerText
        if (need_poet != '' && p.search(need_poet) == -1){
            poet.classList.add('hide')
        }
        else {
            poet.classList.remove('hide')
        }
    }
}



let poets = document.querySelectorAll('.all_poets .poet')
alert(poets)