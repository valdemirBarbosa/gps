function getIdDenuncia(){
      var id_denuncia = document.getElementById("id_denuncia").value;
      document.location.href = "http://localhost/gps/denuncia/novo";
      var id_denuncia_novo = document.getElementById(id_denuncia_novo);
      id_denuncia_novo.innerText = id_denuncia;
}