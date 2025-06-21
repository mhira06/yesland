<?php
	class Sql_tables{
		public function users_main(){
			$response = "tbl_users u
							LEFT JOIN
						tbl_users_login ul ON u.users_id = ul.users_id
							AND ul.password_status = 'active'
							LEFT JOIN
						tbl_login_type lt ON ul.login_type_id = lt.login_type_id
							AND lt.status = 'active'
							LEFT JOIN
						tbl_users_status us ON u.users_id = us.users_id
							AND us.transaction_status = 'active'
							LEFT JOIN
						tbl_users_type_status uts ON us.users_type_status_id = uts.users_type_status_id
							AND uts.status = 'active'
							LEFT JOIN
						tbl_users_type ut ON uts.users_type_id = ut.users_type_id
							AND ut.status = 'active'
							LEFT JOIN
						tbl_employment_status es ON uts.employment_status_id = es.employment_status_id
							AND es.status = 'active'
							LEFT JOIN
						tbl_users_position up ON u.users_id = up.users_id
							AND up.transaction_status = 'active' 
							left join 
						tbl_positions p on up.positions_id = p.positions_id 
							and p.status = 'active' 
							left join 
						tbl_users_rate ur on u.users_id = ur.users_id 
							and ur.transaction_status = 'active' 
							and ur.status = 'active' 
							left join 
						tbl_rate_type rt on ur.rate_type_id = rt.rate_type_id 
							and rt.status = 'active'";
			return $response;
		}
		
		public function identification_main(){
			$response = "tbl_identification id
							LEFT JOIN
						tbl_identification_type id_t ON id.identification_type_id = id_t.identification_type_id
							AND id_t.status = 'active'";
			return $response;
		}
		
		public function users_identification_main(){
			$response = "tbl_users_identification u_id
							LEFT JOIN
						tbl_identification id ON u_id.identification_id = id.identification_id
							AND id.status = 'active'
							LEFT JOIN
						tbl_identification_type id_t ON id.identification_type_id = id_t.identification_type_id
							AND id_t.status = 'active'";
			return $response;
		}
		
		public function users_contact_number_main(){
			$response = "tbl_users_contact_number u_cn
							LEFT JOIN
						tbl_contact_number_type cnt ON u_cn.contact_number_type_id = cnt.contact_number_type_id
							AND cnt.status = 'active'";
			return $response;
		}
		
		public function users_address_main(){
			$response = "tbl_users_address u_ad
							LEFT JOIN
						tbl_address_type ad ON u_ad.address_type_id = ad.address_type_id
							AND ad.status = 'active'";
			return $response;
		}
		
		public function users_type_status(){
			$response = "tbl_users_type_status uts
							LEFT JOIN
						tbl_users_type ut ON uts.users_type_id = ut.users_type_id
							AND ut.status = 'active'
							LEFT JOIN
						tbl_employment_status es ON uts.employment_status_id = es.employment_status_id
							AND es.status = 'active'";
			
			return $response;
		}
		
		public function users_type_leave(){
			$response = "tbl_users_type_leave utl
							LEFT JOIN
						tbl_users_type_status uts ON utl.users_type_status_id = uts.users_type_status_id
							AND uts.status = 'active'
							LEFT JOIN
						tbl_users_type ut ON uts.users_type_id = ut.users_type_id
							AND ut.status = 'active'
							LEFT JOIN
						tbl_employment_status es ON uts.employment_status_id = es.employment_status_id
							AND es.status = 'active'
							LEFT JOIN
						tbl_leave_type lt ON utl.leave_type_id = lt.leave_type_id
							AND lt.status = 'active'";
			return $response;
		}
		
		public function leave_transaction_main(){
			$response = "tbl_leave_transaction ltr
							LEFT JOIN
						tbl_users_leave_credit ulc ON ltr.users_leave_credit_id = ulc.users_leave_credit_id
							AND ulc.status = 'active'
							LEFT JOIN
						tbl_users_type_leave utl ON ulc.users_type_leave_id = utl.users_type_leave_id
							AND utl.status = 'active'
							LEFT JOIN
						tbl_users_type_status uts ON utl.users_type_status_id = uts.users_type_status_id
							AND uts.status = 'active'
							LEFT JOIN
						tbl_users_type ut ON uts.users_type_id = ut.users_type_id
							AND ut.status = 'active'
							LEFT JOIN
						tbl_employment_status es ON uts.employment_status_id = es.employment_status_id
							AND es.status = 'active'
							LEFT JOIN
						tbl_leave_type lt ON utl.leave_type_id = lt.leave_type_id
							AND lt.status = 'active' 
							LEFT JOIN
						tbl_status s ON ltr.status_id = s.status_id
							AND s.status = 'active' 
							LEFT JOIN
						tbl_users u ON ulc.users_id = u.users_id
							AND u.status = 'active'	";
			return $response;
		}
		
		public function users_leave_credit_main(){
			$response = "tbl_users_leave_credit ulc 
							left join 
						tbl_users_type_leave utl ON ulc.users_type_leave_id = utl.users_type_leave_id
							AND utl.status = 'active'
							LEFT JOIN
						tbl_users_type_status uts ON utl.users_type_status_id = uts.users_type_status_id
							AND uts.status = 'active'
							LEFT JOIN
						tbl_users_type ut ON uts.users_type_id = ut.users_type_id
							AND ut.status = 'active'
							LEFT JOIN
						tbl_employment_status es ON uts.employment_status_id = es.employment_status_id
							AND es.status = 'active'
							LEFT JOIN
						tbl_leave_type lt ON utl.leave_type_id = lt.leave_type_id
							AND lt.status = 'active'";
			return $response;
		}
		
		public function leave_dates_main(){
			$response = "tbl_leave_dates ld
							LEFT JOIN
						tbl_leave_transaction ltr ON ld.leave_transaction_id = ltr.leave_transaction_id
							AND ltr.status = 'active' 
							 LEFT JOIN
						tbl_users_leave_credit ulc ON ltr.users_leave_credit_id = ulc.users_leave_credit_id
							AND ulc.status = 'active'
							LEFT JOIN
						tbl_users_type_leave utl ON ulc.users_type_leave_id = utl.users_type_leave_id
							AND utl.status = 'active'";
			return $response;
		}
		
		public function leave_history_main(){
			$response = "tbl_leave_transaction_status_history ltsh
							LEFT JOIN
						tbl_status s ON ltsh.status_id = s.status_id
							AND s.status = 'active'
							LEFT JOIN
						tbl_users u ON ltsh.transact_by = u.users_id
							AND u.status = 'active'";
			return $response;
		}
		
		public function activities_main(){
			$response = "tbl_activities a
							LEFT JOIN
						tbl_status s ON a.status_id = s.status_id
							AND s.status = 'active'
							LEFT JOIN
						tbl_activities_target_attendees ata ON a.activities_id = ata.activities_id
							AND ata.status = 'active'
							LEFT JOIN
						tbl_positions p ON ata.positions_id = p.positions_id
							AND p.status = 'active'";
			return $response;
		}
		
		public function activities_attendess_main(){
			$response = "tbl_activities_attendees att
							LEFT JOIN
						tbl_activities a ON att.activities_id = a.activities_id
							AND a.status = 'active'
							LEFT JOIN
						tbl_users u ON att.users_id = u.users_id
							AND u.status = 'active'
							LEFT JOIN
						tbl_users_status us ON u.users_id = us.users_id
							AND us.status = 'active'
							LEFT JOIN
						tbl_users_type_status uts ON us.users_type_status_id = uts.users_type_status_id
							LEFT JOIN
						tbl_users_type ut ON uts.users_type_id = ut.users_type_id
							AND ut.status = 'active'
							LEFT JOIN
						tbl_status att_s ON att.status_id = att_s.status_id
							AND att_s.status = 'active'";
			return $response;
		}
		
		public function activities_target_attendees_main(){
			$response = "tbl_activities_target_attendees ata
							LEFT JOIN
						tbl_positions p ON ata.positions_id = p.positions_id
							AND p.status = 'active'
							LEFT JOIN
						tbl_activities a ON ata.activities_id = a.activities_id
							AND a.status = 'active'
							JOIN
						tbl_users_position up ON ata.positions_id = up.positions_id
							AND up.status = 'active'
							LEFT JOIN
						tbl_users u ON up.users_id = u.users_id
							AND u.status = 'active'
							LEFT JOIN
						tbl_users_status us ON u.users_id = us.users_id
							AND us.status = 'active'
							LEFT JOIN
						tbl_users_type_status uts ON us.users_type_status_id = uts.users_type_status_id
							LEFT JOIN
						tbl_users_type ut ON uts.users_type_id = ut.users_type_id
							AND ut.status = 'active'
							LEFT JOIN
						tbl_activities_attendees att ON a.activities_id = att.activities_id
							AND u.users_id = att.users_id
							AND att.status = 'active'
							LEFT JOIN
						tbl_status att_s ON att.status_id = att_s.status_id
							AND att_s.status = 'active'";
			return $response;
		}
		
		public function items_stock_main(){
			$response = "tbl_items_stocks ist
							LEFT JOIN
						tbl_items_size isi ON ist.items_sizes_id = isi.items_size_id
							AND isi.status = 'active'
							LEFT JOIN
						tbl_sizes si ON isi.sizes_id = si.sizes_id
							AND si.status = 'active'
							LEFT JOIN
						tbl_items_colors ico ON isi.items_colors_id = ico.items_colors_id
							LEFT JOIN
						tbl_colors co ON ico.colors_id = co.colors_id
							AND co.colors_id
							LEFT JOIN
						tbl_items i ON ico.items_id = i.items_id
							AND i.status = 'active'
							LEFT JOIN
						tbl_items_type it ON i.items_type_id = it.items_type_id
							AND it.status = 'active'
							LEFT JOIN
						tbl_items_prices ipr ON isi.items_size_id = ipr.items_size_id
							AND ipr.status = 'active'";
			return $response;
		}
		
		public function items_order_main(){
			$response = "tbl_items_orders ito
							LEFT JOIN
						tbl_items_size isi ON ito.items_size_id = isi.items_size_id
							LEFT JOIN
						tbl_sizes si ON isi.sizes_id = si.sizes_id
							AND si.status = 'active'
							LEFT JOIN
						tbl_items_colors ico ON isi.items_colors_id = ico.items_colors_id
							LEFT JOIN
						tbl_colors co ON ico.colors_id = co.colors_id
							AND co.colors_id
							LEFT JOIN
						tbl_items i ON ico.items_id = i.items_id
							AND i.status = 'active'
							LEFT JOIN
						tbl_items_type it ON i.items_type_id = it.items_type_id
							AND it.status = 'active'
							LEFT JOIN
						tbl_items_prices ipr ON isi.items_size_id = ipr.items_size_id
							AND ipr.status = 'active'
							LEFT JOIN
						tbl_users u ON ito.users_id = u.users_id
							AND u.status = 'active'
							LEFT JOIN
						tbl_users_status us ON u.users_id = us.users_id
							AND us.status = 'active'
							LEFT JOIN
						tbl_users_type_status uts ON us.users_type_status_id = uts.users_type_status_id
							LEFT JOIN
						tbl_users_type ut ON uts.users_type_id = ut.users_type_id
							AND ut.status = 'active'
							LEFT JOIN
						tbl_status ito_s ON ito.status_id = ito_s.status_id
							AND ito_s.status = 'active'";
			return $response;
		}
		
		public function items_ordered_history_main(){
			$response = "tbl_items_order_history ito_h
							LEFT JOIN
						tbl_users u ON ito_h.transact_by = u.users_id
							AND u.status = 'active'
							LEFT JOIN
						tbl_users_status us ON u.users_id = us.users_id
							AND us.status = 'active'
							LEFT JOIN
						tbl_users_type_status uts ON us.users_type_status_id = uts.users_type_status_id
							LEFT JOIN
						tbl_users_type ut ON uts.users_type_id = ut.users_type_id
							AND ut.status = 'active'
							LEFT JOIN
						tbl_status ito_sh ON ito_h.status_id = ito_sh.status_id
							AND ito_sh.status = 'active'";
			return $response;
		}
		
		public function sales_main(){
			$response = "tbl_sales sa
							LEFT JOIN
						tbl_clients cl ON sa.clients_id = cl.clients_id
							AND cl.status = 'active'
							LEFT JOIN
						tbl_status sa_s ON sa.status_id = sa_s.status_id
							AND sa_s.status = 'active'
							LEFT JOIN
						tbl_users sa_u ON sa.transact_by = sa_u.users_id
							AND sa_u.status = 'active'";
			return $response;
		}
		
		public function documents_request_main(){
			$response = "tbl_documents_request dr
							LEFT JOIN
						tbl_documents_type dt ON dr.documents_type_id = dt.documents_type_id
							AND dt.status = 'active'
							LEFT JOIN
						tbl_status dr_s ON dr.status_id = dr_s.status_id
							AND dr_s.status = 'active'
							LEFT JOIN
						tbl_users u ON dr.transact_by = u.users_id
							AND u.status = 'active'
							LEFT JOIN
						tbl_users_status us ON u.users_id = us.users_id
							AND us.status = 'active'
							LEFT JOIN
						tbl_users_type_status uts ON us.users_type_status_id = uts.users_type_status_id
							LEFT JOIN
						tbl_users_type ut ON uts.users_type_id = ut.users_type_id
							AND ut.status = 'active'";
			return $response;
		}
		
		public function documents_request_history_main(){
			$response = "tbl_documents_request_history drh
							LEFT JOIN
						tbl_status drh_s ON drh.status_id = drh_s.status_id
							AND drh_s.status = 'active'
							LEFT JOIN
						tbl_users u ON drh.transact_by = u.users_id
							AND u.status = 'active'";
			return $response;
		}
	}
?>