function submit() {

    let firstname = document.getElementById("firstname").value;
    let lastname = document.getElementById("lastname").value;

    const request =  "firstname=" + firstname + "&lastname=" + lastname;

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
          alert(this.responseText);
      }
    };
    xhr.open("POST", "./test.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(request);
}