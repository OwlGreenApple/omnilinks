                      <?php 
                      if($links->count()) {
                        foreach($links as $link) {
                      ?>
                          <li class="link-list" id="link-url-update-{{$link->id}}">
                            <div class="div-table mb-4">
                              <div class="div-cell">
                                <span class="handle">
                                  <i class="fas fa-bars"></i>
                                </span>
                              </div>

                              <div class="div-cell">
                                <div class="col-md-12 col-12 pr-0 pl-0">
                                  <div class="input-stack">
                                    <select name="options[]" id="{{$link->id}}" class="form-control link_option wrapper wrapper-{{$link->id}}">
                                      <option value="1" @if($link->options == 1) selected @endif>Link</option>
                                      <option value="2" @if($link->options == 2) selected @endif>Youtube Link (Gunakan link yang lengkap dari browser)</option>
                                    </select>

                                    <div class="sel_{{$link->id}}">
                                      <input type="hidden" name="idlink[]" value="{{$link->id}}">
                                      <input class="delete-link" type="hidden" name="deletelink[]" value="">
                                      <input type="text" name="title[]" value="{{$link->title}}" id="title-{{$link->id}}-view-update" data-id="{{$link->id}}" placeholder="Title" class="form-control focuslink-update" data-icon="@if($link->icon_link == null) 0 @else 1 @endif" maxlength="160">
                                      <span class="wrapper wrapper-{{$link->id}}">
                                        <input type="text" name="url[]" value="{{$link->link}}" placeholder="http://url..." class="form-control">
                                        @if(!is_null($link->icon_link)) 
                                        <div class="row">
                                          <div class="col-lg-10 col-md-10">
                                            <input data-id="{{$link->id}}" data-file="title-{{$link->id}}-view-update" type="file" name="iconlink[]" class="form-control img_icon_preview" />
                                          </div>
                                          <div class="col-lg-2 col-md-2">
                                            <img src="{!!  Storage::disk('s3')->url($link->icon_link) !!}" /> 
                                          </div>
                                        </div>
                                        @else
                                          <input data-id="{{$link->id}}" data-file="title-{{$link->id}}-view-update" type="file" name="iconlink[]" class="form-control img_icon_preview" />
                                        @endif
                                        <small>Rasio ukuran icon 1:1 contoh : 48px x 48px</small>
                                        
                                      </span>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-12 col-12 pr-0 pl-0">
                                  <!-- Youtube Embed Gij0QNsJRxI -->
                                    <input type="text" name="embed[]" class="form-control em_{{$link->id}} emb" value="{{$link->youtube_embed}}" placeholder="masukkan youtube link">

                                    <span class="wrapper wrapper-{{$link->id}}">
                                      <select name="linkpixel[]" id="linkpixel-{{$link->id}}-update" class="form-control linkpixel lnp_{{$link->id}}" data-pixel-id="{{$link->pixel_id}}">
                                      </select>
                                    </span>
                                </div> 
                              </div>
                              
                              <div class="div-cell cell-btn deletelink-update">
                                <span>
                                  <i class="far fa-trash-alt"></i>
                                </span>
                              </div>
                              <div data-id="{{$link->id}}" class="div-cell cell-btn expand">
                                <span>
                                  <i style="font-size : 18px" class="fa fa-caret-down" aria-hidden="true"></i>
                                </span>
                              </div>
                              <!--  -->
                            </div>
                          </li>
                      <?php 
                        }
                      }
                      ?>
