let url_string = window.location.href;
    let url = new URL(url_string);
    let paramValue =  new URLSearchParams(url.search);
    console.log(paramValue);