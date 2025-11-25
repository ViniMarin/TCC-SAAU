<?php $__env->startSection('title', 'FAQ - SAAU'); ?>

<?php $__env->startSection('header-content'); ?>
    <h1 class="page-header-title">PERGUNTAS FREQUENTES</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="accordion shadow-sm" id="faqAccordion" style="border-radius: 20px; overflow: hidden;">
                
                <!-- Item 1 -->
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold text-dark bg-white py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            <i class="far fa-question-circle text-warning me-3 fa-lg"></i> O que é preciso para adotar?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted pb-4">
                            É necessário ser maior de 18 anos, apresentar documento de identidade (CC/NIF), comprovativo de residência e passar por uma breve entrevista. Pedimos também uma contribuição simbólica para ajudar nos custos com vacinas e castração.
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-dark bg-white py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            <i class="fas fa-syringe text-warning me-3 fa-lg"></i> Os animais já são vacinados?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted pb-4">
                            Sim! Todos os animais adultos são entregues vacinados, desparasitados e castrados. Os filhotes são entregues com a primeira dose da vacina e com castração garantida na idade adequada.
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-dark bg-white py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                            <i class="fas fa-home text-warning me-3 fa-lg"></i> Posso visitar o abrigo?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted pb-4">
                            Com certeza! Recebemos visitas de segunda a sábado. Consulte o rodapé do site para ver a morada e os horários de funcionamento atualizados.
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-dark bg-white py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                            <i class="fas fa-gift text-warning me-3 fa-lg"></i> Como posso fazer doações materiais?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted pb-4">
                            Aceitamos ração (cães e gatos), jornais, produtos de limpeza, cobertores, medicamentos e potes. Pode entregar diretamente no abrigo ou em nossos pontos de recolha parceiros na cidade.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/faq.blade.php ENDPATH**/ ?>