import Axios from 'axios';
import React from 'react';
import ReactDOM from 'react-dom';
import swal from 'sweetalert';

function Delete(props) {
    const destroy = (e) => {
        const afterDeleted = e.currentTarget.parentNode.parentNode.parentNode
        console.log(afterDeleted);
        swal({
            title: "Are you sure?",
            text: "Image will deleted permanently!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((value) => {
            if(value == true){
                swal("Your image has been deleted!", {
                    icon: "success",
                });
                axios.delete(props.endpoint).then((response) => {
                    afterDeleted.remove()
                })
            } else {
                swal("Deleted cancel!");
            }
        });
        }
    return (
        <button onClick={destroy} className="btn btn-danger">Delete</button>
    );
}

export default Delete;

if (document.querySelectorAll('.delete')) {
    const deleteNodes = document.querySelectorAll('.delete')
    deleteNodes.forEach((item) => {
        ReactDOM.render(<Delete endpoint={item.getAttribute('endpoint')} />, item);
    })
}
