<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tailwind CSS Modal</title>
        <link
            href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css"
            rel="stylesheet"
        />
        <style>
            .modal {
                transition: opacity 0.25s ease;
            }
            body.modal-active {
                overflow-x: hidden;
                overflow-y: visible !important;
            }
        </style>
        <script
            src="https://kit.fontawesome.com/4569be348d.js"
            crossorigin="anonymous"
        ></script>
    </head>

    <body class="bg-gray-200 flex items-center justify-center h-screen">
        <button
            class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full"
        >
            Open Modal
        </button>
        <button
            class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full"
        >
            Open Modal 2
        </button>

        <!--Modal-->
        <div
            class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center"
        >
            <div
                class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"
            ></div>

            <div
                class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto"
            >
                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                    <!--Title-->
                    <div class="flex justify-center items-center pb-3">
                        <i
                            class="check fa-solid fa-check text-green-600 text-7xl"
                        ></i>
                    </div>

                    <!--Body-->
                    <p class="berhasil text-center">Berhasil menambah data</p>

                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        {{--
                        <button
                            class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2"
                        >
                            Action
                        </button>
                        --}}
                        <button
                            class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const openmodal = document.querySelectorAll(".modal-open");
            openmodal[0].addEventListener("click", function (event) {
                event.preventDefault();
                toggleModal(0);
            });
            openmodal[1].addEventListener("click", function (event) {
                event.preventDefault();
                toggleModal(1);
            });

            const overlay = document.querySelector(".modal-overlay");
            overlay.addEventListener("click", toggleModal);

            const closemodal = document.querySelectorAll(".modal-close");
            for (let i = 0; i < closemodal.length; i++) {
                closemodal[i].addEventListener("click", toggleModal);
            }

            function toggleModal(a) {
                if (a == 1) {
                    const berhasil = document.querySelector(".berhasil");
                    const check = document.querySelector(".check");
                    berhasil.innerText = "Gagal menambah data";
                    check.classList.remove("fa-check", "text-green-600");
                    check.classList.add("fa-times", "text-red-600");
                } else {
                    const berhasil = document.querySelector(".berhasil");
                    berhasil.innerText = "Berhasil menambah data";
                    const check = document.querySelector(".check");
                    check.classList.remove("fa-times", "text-red-600");
                    check.classList.add("fa-check", "text-green-600");
                }
                const body = document.querySelector("body");
                const modal = document.querySelector(".modal");
                modal.classList.toggle("opacity-0");
                modal.classList.toggle("pointer-events-none");
                body.classList.toggle("modal-active");
            }
        </script>
    </body>
</html>
