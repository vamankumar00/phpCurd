function validateForm() {
    let name = document.forms["createForm"]["inventoryName"].value;
    let quantity = document.forms["createForm"]["inventoryQuantity"].value;
    let price = document.forms["createForm"]["inventoryPrice"].value;
    let dateIn = document.forms["createForm"]["inventoryDateIn"].value;
    // let image = document.forms["createForm"]["inventoryImage"].value;

    if (name == "") {
        alert("Input name required");
        return false;
    }
    else {
        let nameValidation = /^[A-Za-z]+$/;
        let checkName = nameValidation.test(name);
        if (checkName == false) {
          alert("Please enter only capital or small latters.");
          return false;
        }    
    }
    if (quantity == "") {
        alert("Input quantity required");
        return false;
    } 
    else {
        let quantityValidation = /^\d+$/;
        let checkQuantity = quantityValidation.test(quantity);
        if (checkQuantity == false) {
          alert("Please enter only 4 digits integer in Quantity.");
          return false;
        }    
    }
    if (price == "") {
        alert("Input price required");
        return false;
    } 
    else {
        let priceValidation = /^\d+$/;
        let checkPrice = priceValidation.test(price);
        if (checkPrice == false) {
          alert("Please enter only 4 digits integer in Quantity.");
          return false;
        }    
    }
    if (dateIn = "") {
        alert("Input Date required");
        return false;
    }
    // else 
    // {
    //     date = new Date(dateIn);
    //     dateInput = date.getTime();
    //     dateFrom = new Date('01/01/2020');
    //     dateTo = new Date();
    //     if ((dateInput > dateFrom.getTime() && dateInput < dateTo.getTime()) == false) {
    //         alert("Out of range");
    //         return false;
    //     }
    // }
}