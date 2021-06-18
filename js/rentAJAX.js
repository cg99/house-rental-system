window.onload = () => {

    const allHouse = document.querySelectorAll(".rent-btn")
    const userIdEL = document.querySelector("#userID");
    const userId = userIdEL?.value;

    const statusBox = document.querySelector("#statusBox");

    const getUrl = window.location;
    const baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    function addToRecord() {
        if (!userId) {
            window.location.href = `${baseUrl}/components/user/login.php`;
            return;
        }

        const houseId = this.dataset.houseid;

        const xmlhttp = new XMLHttpRequest();

        const data = `uid=${userId}&hid=${houseId}`;

        xmlhttp.open("POST", "addRent.php", true);

        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                statusBox.textContent = xmlhttp.responseText;
            }
        };

        xmlhttp.send(data);
        statusBox.textContent = "Processing..."
    }


    allHouse.forEach(function (el) { el.addEventListener('click', addToRecord) });
};