function submitEditForm(event, userId) {
    event.preventDefault(); o

    const formData = new FormData(document.getElementById(`edit-user-form-${userId}`)); 

    fetch(`/users/${userId}`, { 
        method: 'PUT',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.success) {
            loadUserManagement(); 
            alert("Usuario actualizado exitosamente.");
        } else {
            alert("Error al actualizar el usuario.");
        }
    })
    .catch(error => console.error('Error updating user:', error));
}

function deleteUser(userId) {
    if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
        fetch(`/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                document.getElementById(`user-${userId}`).remove(); 
                alert("Usuario eliminado exitosamente.");
            } else {
                alert("Error al eliminar el usuario.");
            }
        })
        .catch(error => console.error('Error deleting user:', error));
    }
}
