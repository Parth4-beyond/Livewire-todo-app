import Swal from "sweetalert2";

const sweetAlert2 = () => {
    const init = () => {
        window.addEventListener("swal", (event) => {
            const { type, payload } = event.detail;

            switch (type) {
                case "confirmDialog":
                    confirmDialogAlert(payload);
                    break;
                case "success":
                default:
                    successAlert(payload);
                    break;
            }
        });
    };

    const successAlert = (payload = {}) => {
        Swal.fire({
            position: "top-end",
            icon: "success",
            showConfirmButton: false,
            timer: 1500,
            title: "Operation Successful!",
            ...payload, // Overrides defaults with payload values if provided
        });
    };

    const confirmDialogAlert = (payload = {}) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            ...payload,
        }).then((result) => {
            if (!result.isConfirmed) {
                return;
            }

            payload?.callback();
        });
    };

    return {
        init,
    };
};

export default sweetAlert2;
