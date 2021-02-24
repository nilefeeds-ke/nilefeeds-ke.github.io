window.onload = function(){
    document.body.addEventListener("DOMContentLoaded", function() {
        

        /*document.querySelector('form').addEventListener('submit', handleSubmit);*/
    });


    /*  // Handle Form Submission
        const handleSubmit = (e) => {
            e.preventDefault();

            let name = document.getElementById('name');
            let email = document.getElementById('email');
            let message = document.getElementById('message');
            let formData = new FormData({name, email, message});
            // TODO: complete form data processing
        }
    */

    //Provide Window Height Per section
    const x = document.getElementsByClassName('h');
    for(let y in x) {
        x[y].style = 'min-height: ' + window.innerHeight + 'px';
    }

    //Jump to Top
    const to_top = document.getElementsByClassName('toTop')[0];
    to_top.addEventListener('click', function(){
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        })
    })

    // set box-shadow on window scroll
    window.addEventListener('scroll', function(){

        const styles = `box-shadow:  5px 5px 10px #105a1f,-5px -5px 10px #40ff7b; background-color:#000000;`;

        if(window.pageYOffset>20){
            document.getElementsByClassName('nav')[0].style= styles;
        }
        else{
            document.getElementsByClassName('nav')[0].style=`box-shadow:  0;`
        }
    })

    // Lazy Loading Image
    const imageLazyLoad = () =>{
        const x = document.body.getElementsByTagName('img');

        for (let i in x){
            x[i].setAttribute('loading', 'lazy');
        }
    }


    (async function fetchProducts(){
        const products = document.querySelector('.products_listing');

        const response = await fetch('/assets/json/main.json');
        const res = await response.json();


        res.forEach((item, index) =>{

            const div = document.createElement('div');
            div.setAttribute('class', 'product');
            const img = document.createElement('img');
            img.setAttribute('src', item['url']);
            img.setAttribute('alt', item['url']);
            div.appendChild(img);
            products.appendChild(div);
        })
    })();

    const n = document.getElementById('send_airtable');
    n.addEventListener('click',submitForm);



}

// Handle Button Clicks
function handleNav(id){
    const scrollToItem = document.getElementById(id);

    if(scrollToItem!== null){
        window.scrollTo({
            top: scrollToItem.offsetTop,
            behavior: 'smooth'
        })
    }
}


function submitForm(event){
    event.preventDefault();
    

    const d = document.querySelector("form");

    const name = d['name'].value;
    const email = d['email'].value;
    const message = d['message'].value;
    if(name === '' || name === null){
        alert('Please enter a name');
    }



    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'https://api.airtable.com/v0/appjVyjR6lG12Wdx7/Nile', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('Authorization', 'Bearer keyuOaEMS1bxTdQ7r');
    if(name !== "" && name !== null){
        if(email !=="" && email !== null)
        {
            xhr.send(JSON.stringify({
                "fields":{
                    'email': email,
                    'Name': name,
                    'Message': message
                }
            }));

            d['name'].value = '';
            d['email'].value = '';
            d['message'].value = '';       
        }
        else{
            alert('Please enter a email');
        }
      
    }
    else{
        alert('Please enter a name');
    }


    
}