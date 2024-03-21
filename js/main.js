// modal

document.addEventListener("click", function (e) {
  if (e.target.classList.contains("gallery-item")) {
    const src = e.target.getAttribute("src");
    document.querySelector(".modal-img").src = src;
    const galleryModal = new bootstrap.Modal(
      document.getElementById("gallery-modal")
    );
    galleryModal.show();
  }
});

//hitung

function hitung() {
  var harga = document.getElementById("hrg").innerText;
  harga = harga.replace("Rp. ", "", "").replace(",", "");
  var d1 = document.getElementById("d1").value;
  var d2 = document.getElementById("d2").value;

  if (d1 !== "" && d2 !== "") {
    const dateOne = new Date(d1);
    const dateTwo = new Date(d2);
    const time = Math.abs(dateTwo - dateOne);
    const days = Math.ceil(time / (1000 * 60 * 60 * 24));

    var total_Harga = harga * days;
    document.getElementById("output").innerHTML = days;
    document.getElementById("total_harga").value = total_Harga;
  } else {
    document.getElementById("output").innerHTML = "-";

    document.getElementById("hasil").innerHTML = "Rp. " + harga;
  }
}
