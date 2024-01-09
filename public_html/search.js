
//Funksioni per Search
const search = () => {
    const searchBox = document.getElementById("search-item").value.toUpperCase();
    const storeItems = document.getElementById("pro-container");
    const product = document.querySelectorAll(".pro");
    const pname = document.getElementsByTagName("h5");

    for (var i = 0; i < pname.length; i++) {
        let match = product[i].getElementsByTagName("h5")[0];
        if (match) {
            let textValue = match.textContent || match.innerHTML;
            if (textValue.toUpperCase().indexOf(searchBox) > -1) {
                product[i].style.display = "";
            } else {
                product[i].style.display = "none";
            }
        }
    }
}
