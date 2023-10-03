<?php

	ob_start(); 
	require_once '../../complex/configuration.php';
	require_once '../../complex/init.php';

	if (!empty($maintaince)) {
		die($maintaince);
	}

	if (!($user->LoggedIn()) || !($user->notBanned($odb)) || !(isset($_SERVER['HTTP_REFERER']))) {
		die();
	}

	$userid = $_SESSION['ID'];	

?>

					
					<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                        <ul class="card-options">
                                       
                                        </ul>
										            <table class="js-table-checkable table table-vcenter">
                                            <tbody>
											<?php

											$select = $odb->prepare("SELECT * FROM `tickets` WHERE `username` = :uname ORDER BY `id` DESC");
											$select->execute(array(':uname' => $_SESSION['username']));
											while($show = $select->fetch(PDO::FETCH_ASSOC)){
												
											
											?>
                                                <tr class="<?php if($show['status'] == "Waiting for user response") echo "active"; ?>">
													<td class="text-center" style="width: 70px;">
                                                        <label class="css-input css-checkbox css-checkbox-primary">
                                                            <input type="checkbox"><span></span>
                                                        </label>
                                                    </td>
													<td>
                                                        <a class="font-w600" href="ticket.php?id=<?php echo $show['id']; ?>"><?php echo $show['subject']; ?></a>
                                                        <div class="text-muted push-5-t"><?php echo substr(strip_tags($show['content']), 0, 20) . ".."; ?></div>
                                                    </td>
													<td class="text-muted"><?php echo $show['status']; ?></td>
                                                    <td class="visible-lg text-muted" style="width: 120px;">
                                                        <em><?php echo date('m-d-Y', $show['date']); ?></em>
                                                    </td>
                                                </tr>
											<?php
											
											}
											
											?>
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                    </div>