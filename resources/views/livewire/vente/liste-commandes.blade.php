<div class="table-responsive">
    <div class="d-flex flex-row-reverse">
        <div class="input-icon">
            <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Recherche...">
            <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>
        </div>
    </div>
        <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
            <thead>
                <tr class="text-left">
                    <th class="pl-0" style="width: 30px">
                        <label class="checkbox checkbox-lg checkbox-inline mr-2">
                            <input type="checkbox" value="1" />
                            <span></span>
                        </label>
                    </th>
                    <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Ref @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                    <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Date @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                    <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Client @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                    <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Date de livraison @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                    <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Quartie de livraison @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                    <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Livreur @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                    <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Statut @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                    <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr @if($loop->even)class="bg-grey"@endif>
                    <td class="pl-0 py-6">
                        <label class="checkbox checkbox-lg checkbox-inline">
                            <input type="checkbox" value="1" />
                            <span></span>
                        </label>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->ref }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->date }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->client->nom }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->date_livraison }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->villeQuartier->nom }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->livreur->nom }}</a>
                    </td>
                    <td class="pl-0">
                        <span class="label label-lg label-light-primary label-inline">{{ $item->etat}}</span>

                        {{-- <select class="form-control" wire:model="etat.{{ $item->ref }}" wire:change="edit('{{ $item->ref }}')" >
                            <option value="Reçue">Reçue</option>
                            <option value="Validée">Validée</option>
                            <option value="Prête">Prête</option>
                            <option value="En Expédition">En Expédition</option>
                            <option value="Livrée">Livrée</option>

                        </select> --}}
                    </td>


                    <td class="pr-0 text-right">
                        <a href="#" wire:click="valider('{{ $item->ref }}')" class="btn btn-light-primary font-weight-bold mr-2">Valider</a>

                        <a href="#" wire:click="show('{{$item->ref}}')" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#show">
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                {{--begin::Svg Icon--}}
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                                {{--end::Svg Icon--}}
                            </span>
                        </a>
                        <a href="#" wire:click="edit('{{$item->ref}}')" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#exampleModalSizeSm">
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                {{--begin::Svg Icon--}}
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    </g>
                                </svg>
                                {{--end::Svg Icon--}}
                            </span>
                        </a>
                        <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" wire:click="deleteDepot('{{$item->id}}')">
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                {{--begin::Svg Icon--}}
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                {{--end::Svg Icon--}}
                            </span>
                        </a>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links('layouts.partials.custom-pagination') }}

        {{-- Show Modal --}}
        <div wire:ignore.self class="modal fade" id="show" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="show" aria-hidden="true">
            <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Commande ') }} - {{$commande_ref}} - {{$date}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                        <!--Progress end-->
                            <div class="md-stepper-horizontal green">

                                <div class="md-step {{$etat_commande === 'Reçue' ? "active" : "done"}}">
                                    <div class="md-step-circle"><span>1</span></div>
                                    <div class="md-step-title">Reçue</div>
                                    <div class="md-step-bar-left"></div>
                                    <div class="md-step-bar-right"></div>
                                    {{$date_recue}}
                                </div>
                                <div class="md-step {{$etat_commande === 'Validée' ? "active" : "done"}}">
                                    <div class="md-step-circle"><span>2</span></div>
                                    <div class="md-step-title">Validée</div>
                                    <div class="md-step-bar-left"></div>
                                    <div class="md-step-bar-right"></div>
                                </div>
                                <div class="md-step {{$etat_commande === 'Prête' ? "active" : "done"}}">
                                    <div class="md-step-circle"><span>3</span></div>
                                    <div class="md-step-title">Prête</div>
                                    <div class="md-step-bar-left"></div>
                                    <div class="md-step-bar-right"></div>
                                </div>
                                <div class="md-step {{$etat_commande === 'En Expédition' ? "active" : "done"}}">
                                    <div class="md-step-circle"><span>4</span></div>
                                    <div class="md-step-title">En Expédition</div>
                                    <div class="md-step-bar-left"></div>
                                    <div class="md-step-bar-right"></div>
                                </div>
                                <div class="md-step {{$etat_commande === 'Livrée' ? "active" : "done"}}">
                                    <div class="md-step-circle"><span>5</span></div>
                                    <div class="md-step-title">Livrée</div>
                                    <div class="md-step-bar-left"></div>
                                    <div class="md-step-bar-right"></div>
                              </div>
                            </div>
                        </div>
                        <!--Progress end-->

                        <!--Info livraison-->
                        <div class="form-group row">

                            <div class="col">
                                <label>{{ __('Téléphone de livraison') }}</label>
                                <input type="text" class="form-control" wire:model.defer="tel_livraison" disabled/>
                            </div>
                            <div class="col">
                                <label>{{ __('Contact de livraison') }}</label>
                                <input type="text" class="form-control" wire:model.defer="contact_livraison" disabled/>
                            </div>

                            <div class="col">
                                <label>{{ __('Adresse de livraison') }}</label>
                                <input type="text" class="form-control" wire:model.defer="adresse_livraison" disabled/>
                            </div>
                            <div class="col">
                                <label>{{ __('Ville de livraison') }}</label>
                                <input type="text" class="form-control" wire:model.defer="ville" disabled/>
                            </div>
                            <div class="col">
                                <label>{{ __('Ville zone') }}</label>
                                <input type="text" class="form-control" wire:model.defer="ville_zone" disabled/>
                            </div>
                            <div class="col">
                                <label>{{ __('Quartier') }}</label>
                                <input type="text" class="form-control" wire:model.defer="ville_quartie_id" disabled/>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <div class="form-group row">
                            <div class="col">
                                <label>{{ __('Mode de paiement') }}</label>
                                <input type="text" class="form-control" wire:model.defer="mode_paiement" disabled/>
                            </div>
                            <div class="col">
                                <label>{{ __('Mode de livraison') }}</label>
                                <input type="text" class="form-control" wire:model.defer="mode_livraison_id" disabled/>
                            </div>
                            <div class="col">
                                <label>{{ __('Frais de livraison') }}</label>
                                <input type="text" class="form-control" placeholder="Frais de livraison" wire:model.defer="frais_livraison" disabled/>
                            </div>

                            <div class="col">
                                <label>{{ __('Date de livraison') }}</label>
                                <input type="date" class="form-control" placeholder="Date de livraison" wire:model.defer="date_livraison" disabled/>
                            </div>

                            <div class="col">
                                <label>{{ __('Livreur') }}</label>
                                <input type="text" class="form-control" wire:model.defer="livreur" disabled/>
                            </div>
                        </div>

                        <!--end Info livraison-->

                        <div class="separator separator-dashed my-10"></div>

                        <!--begin::Table-->
                        <div class="table-responsive">
                            @foreach ($commande_lignes as $categorie_id => $items)
                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_5">
                                    <thead>
                                        <tr class="text-center {{$categorie_id == 1 ? 'bg-primary-o-50' : 'bg-warning-o-50'}}">
                                            <th colspan="5">
                                                {{$categories[$categorie_id]}}
                                            </th>
                                        </tr>
                                        <tr class="text-left">
                                            <th style="min-width: 250px">
                                                <span class="text-dark-75">Produit</span>
                                            </th>
                                            <th style="min-width: 100px">
                                                <span class="text-dark-75">Quantité</span>
                                            </th>
                                            <th style="min-width: 100px">
                                                <span class="text-dark-75">Prix</span>
                                            </th>
                                            <th style="min-width: 100px">
                                                <span class="text-dark-75">Montant</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $key=>$item)
                                            <tr>
                                                <td class="pl-0">
                                                    {{$produits[$categorie_id][$key]}}
                                                </td>
                                                <td class="pl-0">
                                                    {{$item['qte']}}
                                                </td>
                                                <td class="pl-0">
                                                    {{$item['prix']}}
                                                </td>
                                                <td class="pl-0">
                                                    {{$item['montant']}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            @endforeach
                            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_6">
                                <tfoot>
                                    <tr>
                                        <th>Montant total</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$montant_total}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!--end::Table-->

                        {{-- <div class="card card-custom gutter-b">
                            <div class="card-body p-0">
                                <!-- begin: Invoice-->
                                <!-- begin: Invoice header-->
                                <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                                    <div class="col-md-10">
                                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                            <h1 class="display-4 font-weight-boldest mb-10">{{ __('Commande N° :') }}  {{$commande_ref}}</h1>
                                            <div class="d-flex flex-column align-items-md-end px-0">
                                                <!--begin::Logo-->
                                                <a href="#" class="mb-5">
                                                    <img src="/metronic/theme/html/demo13/dist/assets/media/logos/logo-dark.png" alt="">
                                                </a>
                                                <!--end::Logo-->
                                                <span class="d-flex flex-column align-items-md-end opacity-70">
                                                    <span>Cecilia Chapman, 711-2880 Nulla St, Mankato</span>
                                                    <span>Mississippi 96522</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="border-bottom w-100"></div>
                                        <div class="d-flex justify-content-between pt-6">
                                            <div class="d-flex flex-column flex-root">
                                                <span class="font-weight-bolder mb-2">Date Commande</span>
                                                <span class="opacity-70">{{$date}}</span>
                                            </div>
                                            <div class="d-flex flex-column flex-root">
                                                <span class="font-weight-bolder mb-2">N° Commande</span>
                                                <span class="opacity-70">{{$commande_ref}}</span>
                                            </div>
                                            <div class="d-flex flex-column flex-root">
                                                <span class="font-weight-bolder mb-2">Livrée à</span>
                                                <span class="opacity-70">{{$client}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: Invoice header-->
                                <!-- begin: Invoice body-->
                                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                                    <div class="col-md-10">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">Ordered Items</th>
                                                        <th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
                                                        <th class="text-right font-weight-bold text-muted text-uppercase">Unit Price</th>
                                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="font-weight-boldest">
                                                        <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                            <div class="symbol-label" style="background-image: url('/metronic/theme/html/demo13/dist/assets/media/products/11.png')"></div>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        Street Sneakers</td>
                                                        <td class="text-right pt-7 align-middle">2</td>
                                                        <td class="text-right pt-7 align-middle">$90.00</td>
                                                        <td class="text-primary pr-0 pt-7 text-right align-middle">$180.00</td>
                                                    </tr>
                                                    <tr class="font-weight-boldest border-bottom-0">
                                                        <td class="border-top-0 pl-0 py-4 d-flex align-items-center">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                            <div class="symbol-label" style="background-image: url('/metronic/theme/html/demo13/dist/assets/media/products/2.png')"></div>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        Headphones</td>
                                                        <td class="border-top-0 text-right py-4 align-middle">1</td>
                                                        <td class="border-top-0 text-right py-4 align-middle">$449.00</td>
                                                        <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle">$449.00</td>
                                                    </tr>
                                                    <tr class="font-weight-boldest border-bottom-0">
                                                        <td class="border-top-0 pl-0 py-4 d-flex align-items-center">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                            <div class="symbol-label" style="background-image: url('/metronic/theme/html/demo13/dist/assets/media/products/1.png')"></div>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        Smartwatch</td>
                                                        <td class="border-top-0 text-right py-4 align-middle">1</td>
                                                        <td class="border-top-0 text-right py-4 align-middle">$160.00</td>
                                                        <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle">$160.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: Invoice body-->
                                <!-- begin: Invoice footer-->
                                <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
                                    <div class="col-md-10">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="font-weight-bold text-muted text-uppercase">PAYMENT TYPE</th>
                                                        <th class="font-weight-bold text-muted text-uppercase">PAYMENT STATUS</th>
                                                        <th class="font-weight-bold text-muted text-uppercase">PAYMENT DATE</th>
                                                        <th class="font-weight-bold text-muted text-uppercase text-right">TOTAL PAID</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="font-weight-bolder">
                                                        <td>Credit Card</td>
                                                        <td>Success</td>
                                                        <td>Jan 07, 2020</td>
                                                        <td class="text-primary font-size-h3 font-weight-boldest text-right">$789.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: Invoice footer-->
                                <!-- begin: Invoice action-->
                                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                                    <div class="col-md-10">
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Order Details</button>
                                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Order Details</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: Invoice action-->
                                <!-- end: Invoice-->
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Show Modal --}}

    </div>
