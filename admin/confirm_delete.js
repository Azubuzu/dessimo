function deleteElement(ID,name,rest_name) {
    document.getElementById("modal_message").innerHTML = "Êtes-vous sûr de vouloir supprimer " + name +" ?";
    document.getElementById("modal_delete_button").href = rest_name+"s.php?admin_action=delete_"+rest_name+"&delete_ID=" + ID;
}
function deleteElementGallery(photo_ID,bien_ID,name,rest_name) {
    document.getElementById("modal_message").innerHTML = "Êtes-vous sûr de vouloir supprimer " + name +" ?";
    document.getElementById("modal_delete_button").href = rest_name+".php?admin_action=delete_"+rest_name+"&delete_ID=" + photo_ID + "&bien_ID=" + bien_ID;
}