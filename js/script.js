function confirmDelete(albumId) {
    if (confirm("Biztosan törölni szeretnéd ezt az albumot?")) {
        window.location.href = "deleteproduct.php?id=" + albumId;
    } else {
        window.location.href = "product.php";
    }
}


