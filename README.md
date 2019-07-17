# BettingFun
website cá cược bóng đá - an Altplus Internship Project

Football Betting System																					
																							
### I. Tổng quan																							
  - Là hệ thống cá cược dựa trên kết quả các trận đấu bóng đá.																							
  - Quản trị viên đăng kí các trận đấu cho người chơi tham gia (tên đội chủ nhà, tên đội khách, thời điểm bắt đầu trận đấu, thời điểm kết thúc trận đấu, thời điểm dừng nhận cược, tỉ lệ cho từng cửa (thắng/thua/hòa)).																							
  - Người chơi dùng tiền ảo của mình đặt cược cho kết quả trận đấu (thắng/thua hoặc hòa).																							
  - Sau khi quản trị viên cập nhật tỉ số trận đấu, nếu đặt cược đúng, người chơi nhận được số tiền bằng số tiền mình đã cược nhân với tỉ lệ cược. Trong trường hợp ngược lại, người chơi mất số tiền đã cược.																							
																							
### II. Chức năng																							
1. Chức năng chung																						
	- Đăng nhập: đăng nhập bằng tài khoản đã có. Tài khoản mặc định của quản trị viên: username = admin, password = admin_password																		
	- Đăng xuất: chỉ được phép thực hiện sau khi đăng nhập thành công																					
	- Xem danh sách trận đấu: Xem danh sách các trận đấu, tỉ lệ cược, kết quả (nếu có). Khi chọn một trận đấu sẽ hiện thông tin chi tiết về số người đặt cược cho từng cửa của trận đó.																					
2. Quản trị viên:																						
	- Đăng kí trận đấu: 																					
	        + Thông tin trận đấu bao gồm: tên đội chủ nhà, tên đội khách, thời điểm bắt đầu trận đấu, thời điểm kết thúc trận đấu, thời điểm dừng nhận cược, tỉ lệ cho từng cửa (thắng/thua/hòa)																				
		    + Tên 2 đội phải khác nhau																				
		    + Thời điểm dừng nhận cược không được phép là một thời điểm trong quá khứ										
		    + Thời điểm dừng nhận cược không được phép sau thời điểm bắt đầu trận đấu							 							- Công bố trận đấu: 																					
		    + Một trận đấu sau khi tạo xong mặc định ở chế độ ẩn, chỉ quản trị viên có thể xem, người chơi không xem được (do đó sẽ không đặt cược được)																				
		    + Quản trị viên có thể công bố các trận đấu đang bị ẩn. Sau khi công bố, người chơi có thể xem được thông tin và tiến hành đặt cược.																				
	- Chỉnh sửa thông tin trận đấu:																					
		    + Những thông tin được chỉnh sửa: tên 2 đội, thời điểm kết thúc trận đấu, thời điểm dừng nhận cược, tỉ lệ cho từng cửa (thắng/thua/hòa).																				
		    + Chỉ cho phép sửa thông tin các trận đấu chưa công bố.																				
	- Cập nhật kết quả:   																					
			+ Nhập kết quả trận đấu.																				
			+ Sau khi kết quả được cập nhật, hệ thống tự động tính lại tiền cho những người tham gia đặt cược trong trận đấu đó.																				
			+ Chỉ được phép cập nhật kết quả sau thời điểm trận đấu kết thúc.					 															
	- Xóa một trận đấu: một trận đấu nếu đã có ít nhất một người tham gia cược thì không được phép xóa.																					
		    - Trong màn hình xem danh sách trận đấu, khi chọn một trận đấu, có thể xem chi tiết những ai đặt cho cược cho cửa nào với số tiền là bao nhiêu. Nếu trận đấu đã có kết quả, hiện kèm thông tin số tiền thu về hoặc mất đi của từng người.																					
3. Người chơi:																						 
	- Đăng kí tài khoản: 																					
			+ Màn hình đăng kí phải bao gồm các trường username, password, password (confirm), email address																				
			+ Không được phép đăng kí trùng username hay trùng email address.																				
	- Đặt cược:  																					
			+ Trong màn hình xem danh sách trận đấu, có thể tham gia đặt cược cho các trận đấu vẫn còn chưa hết hạn đặt cược.																				
			+ Khi đặt cược một số tiền cho một trận đấu nhất định, số tiền đó bị trừ trong tài khoản.																				
			+ Không được phép đặt cược với số tiền lớn hơn số tiền hiện có.																				
	- Lịch sử đặt cược:																					
			+ Xem lại lịch sử đặt cược của bản thân.																				
			+ Nếu trận đấu đã có kết quả, hiện kèm thông tin số tiền thu về hoặc mất đi.																				
	- Tài khoản ban đầu: 																					
			+ Số tiền ban đầu người chơi có được khi tạo tài khoản là 5000 Coin																				
