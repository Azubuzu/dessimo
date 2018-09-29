function deleteElement(ID,name,rest_name) {
    document.getElementById("modal_message").innerHTML = "Êtes-vous sûr de vouloir supprimer " + name +" ?";
    document.getElementById("modal_delete_button").href = "biens.php?admin_action="+rest_name+"&delete_ID=" + ID;
}