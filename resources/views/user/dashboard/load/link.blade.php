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
                                    <input type="hidden" name="idlink[]" value="{{$link->id}}">
                                    <input class="delete-link" type="hidden" name="deletelink[]" value="">
                                    <input type="text" name="title[]" value="{{$link->title}}" id="title-{{$link->id}}-view-update" placeholder="Title" class="form-control focuslink-update">
                                    <input type="text" name="url[]" value="{{$link->link}}" placeholder="http://url..." class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-12 col-12 pr-0 pl-0">
                                  <select name="linkpixel[]" id="linkpixel-{{$link->id}}-update" class="form-control linkpixel" data-pixel-id="{{$link->pixel_id}}">
                                  </select>
                                </div> 
                              </div>
                              
                              <div class="div-cell cell-btn deletelink-update">
                                <span>
                                  <i class="far fa-trash-alt"></i>
                                </span>
                              </div>
                            </div>
                          </li>
                      <?php 
                        }
                      }
                      ?>
