<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/report copy 5.css">
    <link rel="stylesheet" href="css/modal copy 2.css">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Document</title>
</head>
<?php include_once "navbar.php" ?>
<body>
    <div class="modal" id="modal">
        <div class="cardmodal">
            <div class="bodymodal">
                <div class="modalhead">
                    <span style="font-size: 30px;">Add Kamenrider Series</span>
                    <span id="close">&times;</span>
                </div>
                <form id="formXD">

                </form>
            </div>
        </div>
    </div>
    <div class="cardheadbtn">
        <button onclick="addkamen()" class="btnadd" type="button">ADD</button>
    </div>
    <div class="card" id="simple_table">
        <table id="simple_table">
            <thead id="thd">
            </thead>
            <tbody id="tbo">
            </tbody>
            <!-- <img src="" alt="" > -->

        </table>
    </div>
    <!-- <input type="button" onclick="generate()" value="Export To PDF" /> -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
<script src="js/modal.js"></script>
<script>
    var tbos = document.getElementById('tbo')
    var thd = document.getElementById('thd')
    var theaxd = null;
    var arrdata = [];
    var btnedit = null;
    var btndelete = null;
    var formXD = document.getElementById('formXD');

    window.onload = async () => {
        display();
    }

    async function display() {
        try {
            const resx = await fetch('../php/rest.php?dataera=OK', {
                method: 'GET'
            })
            if (resx.ok) {
                const datax = await resx.json();
                console.log(datax);
                let keyxd = Object.keys(datax[0]);
                theaxd = keyxd
                thd.innerHTML = "";
                for (const key in keyxd) {
                    var th = document.createElement('th')
                    th.innerHTML = keyxd[key]
                    thd.appendChild(th)
                }
                var th = document.createElement('th')
                th.innerHTML = 'แก้ไข'
                thd.appendChild(th)
                var th = document.createElement('th')
                th.innerHTML = 'ลบ'
                thd.appendChild(th)
                tbos.innerHTML = ""
                for (const key in datax) {
                    arrdata.push(Object.values(datax[key]))
                    var tr = document.createElement('tr')
                    tbos.appendChild(tr)
                    for (const key1 in datax[key]) {
                        // console.log(key1);
                        if (key1 == 'era_img') {
                            var td = document.createElement('td')
                            // td.innerHTML = ' <img width="50" height="50" src="../img/logorider/' + datax[key][key1] + '" alt="">'
                            td.innerHTML = ' <img width="50" height="50" src="../img/logoera/' + datax[key][key1] + '" alt="">'
                            tr.appendChild(td)
                        }else if(key1 == 'era_description'){
                            var td = document.createElement('td')
                            td.innerHTML = '<textarea name="" id="" cols="30" rows="10" readonly>'+datax[key][key1]+'</textarea>'
                            tr.appendChild(td)
                        } else {
                            var td = document.createElement('td')
                            td.innerHTML = datax[key][key1]
                            tr.appendChild(td)
                        }
                    }
                    var td = document.createElement('td')
                    td.innerHTML = '<button class="btnedit" onclick="editdata(' + datax[key].era_id + ')" type="button">แก้ไข</button>'
                    tr.appendChild(td)
                    var td = document.createElement('td')
                    td.innerHTML = '<button class="btndelete" onclick="deletedata(' + datax[key].era_id + ')" type="button">ลบ</button>'
                    tr.appendChild(td)
                }
                console.log(arrdata);
            } else {
                throw new Error(resx.status)
            }
        } catch (ex) {
            console.log(ex.message);
        }
    }

    async function editdata(id) {
        modal.style.display = "block"
        formXD.innerHTML = ""
        console.log(id);
        try {
            const res = await fetch('restmodal.php?eraid=' + id, {
                method: 'GET'
            })
            if (res.ok) {
                const datax = await res.text();
                // console.log(datax);
                formXD.innerHTML = datax
                formXD.setAttribute('data-name', 'edit')
            } else {
                throw new Error(res.status)
            }
        } catch (e) {
            console.log(e.message);
        }
    }



    formXD.onsubmit = async (e) => {
        e.preventDefault();
        console.log(e.target.dataset.name);
        if (e.target.dataset.name == 'edit') {
            editdataXD();
        } else {
            adddataXD()
        }
    }

    async function editdataXD() {
        var formdataXD = new FormData()
        formdataXD.append('era_id', formXD.elements['era_id'].value)
        formdataXD.append('era_name', formXD.elements['era_name'].value)
        formdataXD.append('era_description', formXD.elements['era_description'].value)
        if (formXD.elements['fileimg'].files[0] == undefined) {
            formdataXD.append('era_img', formXD.elements['era_img'].value)
        } else {
            formdataXD.append('era_img', formXD.elements['fileimg'].files[0])
        }
        try {
            const res = await fetch('../php/rest.php', {
                method: 'POST',
                body: formdataXD
            })
            if (res.ok) {
                const datax = await res.json();
                if (datax.message == "success") {
                    display();
                    modal.style.display = "none"
                }
                console.log(datax);
            } else {
                throw new Error(res.status)
            }
        } catch (e) {
            console.log(e.message);
        }
    }


    async function addkamen() {
        modal.style.display = "block"
        formXD.innerHTML = ""
        try {
            const res = await fetch('restmodal.php?eraadd=ok', {
                method: 'GET'
            })
            if (res.ok) {
                const datax = await res.text();
                formXD.innerHTML = datax;
                formXD.setAttribute('data-name', 'add')
            } else {
                throw new Error(res.status)
            }
        } catch (e) {
            console.log(e.message);
        }
    }

    async function adddataXD() {
        var formdataXD = new FormData()
        formdataXD.append('era_namexd', formXD.elements['era_name'].value)
        formdataXD.append('era_descriptionxd', formXD.elements['era_description'].value)
        formdataXD.append('era_imgxd', formXD.elements['fileimg'].files[0])
        try {
            const res = await fetch('../php/rest.php', {
                method: 'POST',
                body: formdataXD
            })
            if (res.ok) {
                const datax = await res.json();
                if (datax.message == "success") {
                    display();
                    modal.style.display = "none"
                }
                console.log(datax)
            } else {
                throw new Error(res.status)
            }
        } catch (e) {
            console.log(e.message);
        }
    }

    async function deletedata(id) {
        try {
            const res = await fetch('../php/rest.php?era_xd=' + id, {
                method: 'GET'
            })
            if (res.ok) {
                const datax = await res.json();
                console.log(datax);
                if (datax.message == "success") {
                    display();
                }
            } else {
                throw new Error(res.status)
            }
        } catch (e) {
            console.log(e.message);
        }
    }
    // function generate() {
    //     let doc = new jsPDF()

    //     doc.autoTable({
    //         head: [
    //             theaxd
    //         ],
    //         body: arrdata,
    //         // headerStyles: {
    //         //     lineWidth: 2,
    //         // }
    //     })
    //     doc.save("output.pdf")
    // }
</script>

</html>