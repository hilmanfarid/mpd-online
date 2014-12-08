<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_ppatGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="SELECT *
FROM t_bphtb_lembar_kendali
WHERE upper(wp_name) LIKE '%{s_keyword}%'
ORDER BY t_bphtb_lembar_kendali_id" orderBy="p_vat_type_id">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_bphtb_lembar_kendali.ccp" wizardThemeItem="GridA" PathID="t_ppatGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="219" sourceType="DataField" name="t_bphtb_lembar_kendali_id" source="t_bphtb_lembar_kendali_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="244" fieldSourceType="DBColumn" dataType="Text" html="False" name="wp_name" fieldSource="wp_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridwp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_bphtb_lembar_kendali_id" fieldSource="t_bphtb_lembar_kendali_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_ppatGridt_bphtb_lembar_kendali_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="registration_no" fieldSource="registration_no" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridregistration_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_by" fieldSource="updated_by" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridupdated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="t_bphtb_lembar_kendali.ccp" removeParameters="t_bphtb_lembar_kendali_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="t_ppatGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="247" fieldSourceType="DBColumn" dataType="Text" html="False" name="wp_address_name" fieldSource="wp_address_name" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridwp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_date" fieldSource="updated_date" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridupdated_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="226"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="227"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="0" parameterSource="s_keyword"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="0" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="225" fieldName="to_char(updated_date,'DD-MON-YYYY')" isExpression="True" alias="updated_date"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="149" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_ppatSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_bphtb_lembar_kendali.ccp" PathID="t_ppatSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_ppatSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" PathID="t_ppatSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_ppatForm" connection="ConnSIKP" dataSource="select a.*, to_char(a.tgl_masuk,'DD-MM-YYYY') as tgl_masuk,
b.region_name as wp_kota,
c.region_name as wp_kecamatan,
d.region_name as wp_kelurahan,
e.region_name as object_region,
f.region_name as object_kecamatan,
g.region_name as object_kelurahan,
h.pemeriksa_nama as nama_pemeriksa, h.pemeriksa_nip as nip_pemeriksa, h.pemeriksa_jabatan as jabatan_pemeriksa
from t_bphtb_lembar_kendali as a 
left join p_region as b
	on a.wp_p_region_id = b.p_region_id
left join p_region as c
	on a.wp_p_region_id_kec = c.p_region_id
left join p_region as d
	on a.wp_p_region_id_kel = d.p_region_id
left join p_region as e
	on a.object_p_region_id = e.p_region_id
left join p_region as f
	on a.object_p_region_id_kec = f.p_region_id
left join p_region as g
	on a.object_p_region_id_kel = g.p_region_id
left join t_bphtb_exemption_pemeriksa as h
	on a.administrator_id = h.t_bphtb_exemption_pemeriksa_id
where a.t_bphtb_lembar_kendali_id = {t_bphtb_lembar_kendali_id}" customInsertType="SQL" customInsert="INSERT INTO t_bphtb_lembar_kendali
(registration_no, jenis_perolehan_hak, wp_name, npwp, wp_address_name, wp_rt, wp_rw, wp_p_region_id, wp_p_region_id_kec, wp_p_region_id_kel,
phone_no, mobile_phone_no, njop_pbb, object_address_name, object_rt, object_rw, object_p_region_id, object_p_region_id_kec,
object_p_region_id_kel, tgl_masuk, nilai_njop, harga_transaksi, jumlah_disetor, administrator_id, creation_date, created_by, updated_date, 
updated_by)
VALUES('{registration_no}','{jenis_perolehan_hak}','{wp_name}','{npwp}','{wp_address_name}','{wp_rt}','{wp_rw}',{wp_p_region_id},{wp_p_region_id_kec},{wp_p_region_id_kel},
'{phone_no}','{mobile_phone_no}','{njop_pbb}','{object_address_name}','{object_rt}','{object_rw}',{object_p_region_id},{object_p_region_id_kec},
{object_p_region_id_kel},'{tgl_masuk}',{nilai_njop},{harga_transaksi},{jumlah_disetor},{administrator_id}, '{creation_date}','{created_by}','{updated_date}','{updated_by}')" customUpdateType="SQL" customUpdate="UPDATE t_bphtb_lembar_kendali
SET registration_no = '{registration_no}',
jenis_perolehan_hak = '{jenis_perolehan_hak}',
wp_name = '{wp_name}',
npwp = '{npwp}',
wp_address_name = '{wp_address_name}',
wp_rt = '{wp_rt}',
wp_rw = '{wp_rw}',
wp_p_region_id = {wp_p_region_id},
wp_p_region_id_kec = {wp_p_region_id_kec},
wp_p_region_id_kel = {wp_p_region_id_kel},
phone_no = '{phone_no}',
mobile_phone_no = '{mobile_phone_no}',
njop_pbb = '{njop_pbb}',
object_address_name = '{object_address_name}',
object_rt = '{object_rt}',
object_rw = '{object_rw}',
object_p_region_id = {object_p_region_id},
object_p_region_id_kec = {object_p_region_id_kec},
object_p_region_id_kel = {object_p_region_id_kel},
tgl_masuk = '{tgl_masuk}',
nilai_njop = {nilai_njop},
harga_transaksi = {harga_transaksi},
jumlah_disetor = {jumlah_disetor},
administrator_id = {administrator_id},
updated_date = '{updated_date}',
updated_by = '{updated_by}'
WHERE t_bphtb_lembar_kendali_id = {t_bphtb_lembar_kendali_id}" customDeleteType="SQL" customDelete="DELETE FROM t_bphtb_lembar_kendali WHERE  t_bphtb_lembar_kendali_id = {t_bphtb_lembar_kendali_id}" PathID="t_ppatForm" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" activeCollection="USQLParameters">
<Components>
<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" removeParameters="FLAG" PathID="t_ppatFormButton_Insert">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" removeParameters="FLAG" PathID="t_ppatFormButton_Update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" removeParameters="FLAG;p_simple_parameter_type_id;p_simple_parameter_typeGridPage;s_keyword" PathID="t_ppatFormButton_Delete">
<Components/>
<Events>
<Event name="OnClick" type="Client">
<Actions>
<Action actionName="Confirmation Message" actionCategory="General" id="362" message="Delete record?"/>
</Actions>
</Event>
</Events>
<Attributes/>
<Features/>
</Button>
<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" removeParameters="FLAG;p_simple_parameter_type_id;p_simple_parameter_typeGridPage;s_keyword" PathID="t_ppatFormButton_Cancel">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="t_bphtb_lembar_kendali_id" caption="Id" fieldSource="t_bphtb_lembar_kendali_id" required="False" PathID="t_ppatFormt_bphtb_lembar_kendali_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no" caption="Description" fieldSource="phone_no" required="False" PathID="t_ppatFormphone_no">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" caption="Creation Date" fieldSource="creation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)" required="False" PathID="t_ppatFormcreation_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" caption="Created By" fieldSource="created_by" defaultValue="CCGetUserLogin()" required="False" PathID="t_ppatFormcreated_by">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" caption="Updated Date" fieldSource="updated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)" required="False" PathID="t_ppatFormupdated_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" caption="Updated By" fieldSource="updated_by" defaultValue="CCGetUserLogin()" required="False" PathID="t_ppatFormupdated_by">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="269" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_phone_no" caption="No Handphone" fieldSource="mobile_phone_no" required="False" PathID="t_ppatFormmobile_phone_no">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="369" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" fieldSource="wp_name" PathID="t_ppatFormwp_name">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="370" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwp" fieldSource="npwp" PathID="t_ppatFormnpwp">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="371" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" fieldSource="wp_address_name" PathID="t_ppatFormwp_address_name">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="372" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_rt" fieldSource="wp_rt" PathID="t_ppatFormwp_rt">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="373" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_rw" fieldSource="wp_rw" PathID="t_ppatFormwp_rw">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="374" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kota" caption="Kota/Kabupaten - WP" fieldSource="wp_kota" defaultValue="'KOTA BANDUNG'" required="True" PathID="t_ppatFormwp_kota">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<Hidden id="376" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id" caption="Kota/Kabupaten - WP" fieldSource="wp_p_region_id" defaultValue="749" required="True" PathID="t_ppatFormwp_p_region_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="377" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kec" caption="Kecamatan - WP" fieldSource="wp_p_region_id_kec" required="True" PathID="t_ppatFormwp_p_region_id_kec">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<TextBox id="379" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kecamatan" caption="Kecamatan - WP" fieldSource="wp_kecamatan" required="True" PathID="t_ppatFormwp_kecamatan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="380" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kelurahan" caption="Kelurahan - WP" fieldSource="wp_kelurahan" required="True" PathID="t_ppatFormwp_kelurahan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<Hidden id="382" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kel" caption="Kelurahan - WP" fieldSource="wp_p_region_id_kel" required="True" PathID="t_ppatFormwp_p_region_id_kel">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<ListBox id="209" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="jenis_perolehan_hak" fieldSource="jenis_perolehan_hak" connection="ConnSIKP" dataSource="Waris;Waris;Fasos;Fasos;Rumah Dinas;Rumah Dinas;Waris Gono-Gini;Waris Gono-Gini;Hibah;Hibah;Peralihan Hak Baru;Peralihan Hak Baru" required="False" PathID="t_ppatFormjenis_perolehan_hak">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
<TextBox id="383" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="registration_no" fieldSource="registration_no" PathID="t_ppatFormregistration_no">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="384" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tgl_masuk" fieldSource="tgl_masuk" PathID="t_ppatFormtgl_masuk" format="dd-mm-yyyy">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="385" name="DatePicker_tgl_masuk1" PathID="t_ppatFormDatePicker_tgl_masuk1" control="tgl_masuk" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/CoffeeBreak/Style.css">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="386" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="njop_pbb" PathID="t_ppatFormnjop_pbb" fieldSource="njop_pbb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="387" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_address_name" PathID="t_ppatFormobject_address_name" fieldSource="object_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="388" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_rt" PathID="t_ppatFormobject_rt" fieldSource="object_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="389" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_rw" PathID="t_ppatFormobject_rw" fieldSource="object_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="390" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kota" fieldSource="object_region" required="True" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormobject_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="392" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_ppatFormobject_p_region_id" fieldSource="object_p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="393" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kecamatan" caption="Kecamatan - WP" fieldSource="object_kecamatan" required="True" PathID="t_ppatFormobject_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="395" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_ppatFormobject_p_region_id_kec" fieldSource="object_p_region_id_kec" caption="Kecamatan - Object" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="396" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kelurahan" fieldSource="object_kelurahan" required="True" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormobject_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="398" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id_kel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_ppatFormobject_p_region_id_kel" fieldSource="object_p_region_id_kel" caption="Kelurahan - Object" required="True" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="399" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="nilai_njop" PathID="t_ppatFormnilai_njop" fieldSource="nilai_njop" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="400" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="harga_transaksi" PathID="t_ppatFormharga_transaksi" fieldSource="harga_transaksi" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="401" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="jumlah_disetor" PathID="t_ppatFormjumlah_disetor" fieldSource="jumlah_disetor" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<ListBox id="222" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" returnValueType="Number" name="administrator_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_ppatFormadministrator_id" fieldSource="administrator_id" connection="ConnSIKP" dataSource="SELECT * FROM t_bphtb_exemption_pemeriksa
WHERE pemeriksa_status = 'administrator'" boundColumn="t_bphtb_exemption_pemeriksa_id" textColumn="pemeriksa_nama">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
<Button id="458" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update1" operation="Update" removeParameters="FLAG" PathID="t_ppatFormButton_Update1">
<Components/>
<Events>
<Event name="OnClick" type="Client">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="459"/>
</Actions>
</Event>
</Events>
<Attributes/>
<Features/>
</Button>
</Components>
<Events/>
<TableParameters>
<TableParameter id="154" conditionType="Parameter" useIsNull="False" field="p_hotel_grade_id" dataType="Float" searchConditionType="Equal" parameterType="URL" parameterSource="p_hotel_grade_id" logicOperator="And"/>
</TableParameters>
<SPParameters/>
<SQLParameters>
<SQLParameter id="182" variable="t_bphtb_lembar_kendali_id" dataType="Float" parameterType="URL" parameterSource="t_bphtb_lembar_kendali_id" defaultValue="0"/>
</SQLParameters>
<JoinTables/>
<JoinLinks/>
<Fields/>
<ISPParameters/>
<ISQLParameters>
<SQLParameter id="402" variable="registration_no" parameterType="Control" dataType="Text" parameterSource="registration_no"/>
<SQLParameter id="403" variable="jenis_perolehan_hak" parameterType="Control" dataType="Text" parameterSource="jenis_perolehan_hak"/>
<SQLParameter id="404" variable="wp_name" parameterType="Control" dataType="Text" parameterSource="wp_name"/>
<SQLParameter id="405" variable="npwp" parameterType="Control" dataType="Text" parameterSource="npwp"/>
<SQLParameter id="406" variable="wp_address_name" parameterType="Control" dataType="Text" parameterSource="wp_address_name"/>
<SQLParameter id="407" variable="wp_rt" parameterType="Control" dataType="Text" parameterSource="wp_rt"/>
<SQLParameter id="408" variable="wp_rw" parameterType="Control" dataType="Text" parameterSource="wp_rw"/>
<SQLParameter id="409" variable="wp_p_region_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="wp_p_region_id"/>
<SQLParameter id="410" variable="wp_p_region_id_kec" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="wp_p_region_id_kec"/>
<SQLParameter id="411" variable="wp_p_region_id_kel" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="wp_p_region_id_kel"/>
<SQLParameter id="412" variable="phone_no" parameterType="Control" dataType="Text" parameterSource="phone_no"/>
<SQLParameter id="413" variable="mobile_phone_no" parameterType="Control" dataType="Text" parameterSource="mobile_phone_no"/>
<SQLParameter id="414" variable="njop_pbb" parameterType="Control" dataType="Text" parameterSource="njop_pbb"/>
<SQLParameter id="415" variable="object_address_name" parameterType="Control" dataType="Text" parameterSource="object_address_name"/>
<SQLParameter id="416" variable="object_rt" parameterType="Control" dataType="Text" parameterSource="object_rt"/>
<SQLParameter id="417" variable="object_rw" parameterType="Control" dataType="Text" parameterSource="object_rw"/>
<SQLParameter id="418" variable="object_p_region_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="object_p_region_id"/>
<SQLParameter id="419" variable="object_p_region_id_kec" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="object_p_region_id_kec"/>
<SQLParameter id="420" variable="object_p_region_id_kel" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="object_p_region_id_kel"/>
<SQLParameter id="421" variable="tgl_masuk" parameterType="Control" dataType="Text" format="dd-mmm-yyyy" parameterSource="tgl_masuk"/>
<SQLParameter id="422" variable="nilai_njop" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="nilai_njop"/>
<SQLParameter id="423" variable="harga_transaksi" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="harga_transaksi"/>
<SQLParameter id="424" variable="jumlah_disetor" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="jumlah_disetor"/>
<SQLParameter id="425" variable="creation_date" parameterType="Control" dataType="Text" format="dd-mmm-yyyy" parameterSource="creation_date"/>
<SQLParameter id="426" variable="created_by" parameterType="Control" dataType="Text" parameterSource="created_by"/>
<SQLParameter id="427" variable="updated_date" parameterType="Control" dataType="Text" format="dd-mmm-yyyy" parameterSource="updated_date"/>
<SQLParameter id="428" variable="updated_by" parameterType="Control" dataType="Text" format="dd-mmm-yyyy" parameterSource="updated_by"/>
<SQLParameter id="456" variable="administrator_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="administrator_id"/>
</ISQLParameters>
<IFormElements>
<CustomParameter id="231" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
<CustomParameter id="232" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
<CustomParameter id="233" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
<CustomParameter id="234" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
<CustomParameter id="273" field="t_ppat_id" dataType="Float" parameterType="Control" parameterSource="t_ppat_id" omitIfEmpty="True"/>
<CustomParameter id="274" field="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no" omitIfEmpty="True"/>
<CustomParameter id="275" field="ppat_name" dataType="Text" parameterType="Control" parameterSource="ppat_name" omitIfEmpty="True"/>
<CustomParameter id="276" field="address_name" dataType="Text" parameterType="Control" parameterSource="address_name" omitIfEmpty="True"/>
<CustomParameter id="277" field="address_no" dataType="Text" parameterType="Control" parameterSource="address_no" omitIfEmpty="True"/>
<CustomParameter id="278" field="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt" omitIfEmpty="True"/>
<CustomParameter id="279" field="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw" omitIfEmpty="True"/>
<CustomParameter id="280" field="kota" dataType="Text" parameterType="Control" parameterSource="kota" omitIfEmpty="True"/>
<CustomParameter id="281" field="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id" omitIfEmpty="True"/>
<CustomParameter id="282" field="kecamatan" dataType="Text" parameterType="Control" parameterSource="kecamatan" omitIfEmpty="True"/>
<CustomParameter id="283" field="p_region_id_kec" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec" omitIfEmpty="True"/>
<CustomParameter id="284" field="kelurahan" dataType="Text" parameterType="Control" parameterSource="kelurahan" omitIfEmpty="True"/>
<CustomParameter id="285" field="wp_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel" omitIfEmpty="True"/>
<CustomParameter id="286" field="identification_no" dataType="Text" parameterType="Control" parameterSource="identification_no" omitIfEmpty="True"/>
<CustomParameter id="287" field="personal_identification_id" dataType="Text" parameterType="Control" parameterSource="personal_identification_id" omitIfEmpty="True"/>
<CustomParameter id="288" field="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no" omitIfEmpty="True"/>
<CustomParameter id="289" field="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no" omitIfEmpty="True"/>
<CustomParameter id="290" field="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code" omitIfEmpty="True"/>
<CustomParameter id="291" field="email_address" dataType="Text" parameterType="Control" parameterSource="email_address" omitIfEmpty="True"/>
</IFormElements>
<USPParameters/>
<USQLParameters>
<SQLParameter id="430" variable="jenis_perolehan_hak" parameterType="Control" dataType="Text" parameterSource="jenis_perolehan_hak"/>
<SQLParameter id="431" variable="wp_name" parameterType="Control" dataType="Text" parameterSource="wp_name"/>
<SQLParameter id="432" variable="npwp" parameterType="Control" dataType="Text" parameterSource="npwp"/>
<SQLParameter id="433" variable="wp_address_name" parameterType="Control" dataType="Text" parameterSource="wp_address_name"/>
<SQLParameter id="434" variable="wp_rt" parameterType="Control" dataType="Text" parameterSource="wp_rt"/>
<SQLParameter id="435" variable="wp_rw" parameterType="Control" dataType="Text" parameterSource="wp_rw"/>
<SQLParameter id="436" variable="wp_p_region_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="wp_p_region_id"/>
<SQLParameter id="437" variable="wp_p_region_id_kec" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="wp_p_region_id_kec"/>
<SQLParameter id="438" variable="wp_p_region_id_kel" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="wp_p_region_id_kel"/>
<SQLParameter id="439" variable="phone_no" parameterType="Control" dataType="Text" parameterSource="phone_no"/>
<SQLParameter id="440" variable="mobile_phone_no" parameterType="Control" dataType="Text" parameterSource="mobile_phone_no"/>
<SQLParameter id="441" variable="njop_pbb" parameterType="Control" dataType="Text" parameterSource="njop_pbb"/>
<SQLParameter id="442" variable="object_address_name" parameterType="Control" dataType="Text" parameterSource="object_address_name"/>
<SQLParameter id="443" variable="object_rt" parameterType="Control" dataType="Text" parameterSource="object_rt"/>
<SQLParameter id="444" variable="object_rw" parameterType="Control" dataType="Text" parameterSource="object_rw"/>
<SQLParameter id="445" variable="object_p_region_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="object_p_region_id"/>
<SQLParameter id="446" variable="object_p_region_id_kec" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="object_p_region_id_kec"/>
<SQLParameter id="447" variable="object_p_region_id_kel" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="object_p_region_id_kel"/>
<SQLParameter id="448" variable="tgl_masuk" parameterType="Control" dataType="Text" format="dd-mmm-yyyy" parameterSource="tgl_masuk"/>
<SQLParameter id="449" variable="nilai_njop" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="nilai_njop"/>
<SQLParameter id="450" variable="harga_transaksi" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="harga_transaksi"/>
<SQLParameter id="451" variable="jumlah_disetor" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="jumlah_disetor"/>
<SQLParameter id="452" variable="updated_date" parameterType="Control" dataType="Text" format="dd-mmm-yyyy" parameterSource="updated_date"/>
<SQLParameter id="453" variable="updated_by" parameterType="Control" dataType="Text" parameterSource="updated_by"/>
<SQLParameter id="454" variable="t_bphtb_lembar_kendali_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_bphtb_lembar_kendali_id"/>
<SQLParameter id="455" variable="registration_no" parameterType="Control" dataType="Text" parameterSource="registration_no"/>
<SQLParameter id="457" variable="administrator_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="administrator_id"/>
</USQLParameters>
<UConditions>
<TableParameter id="337" conditionType="Parameter" useIsNull="False" field="t_ppat_id" dataType="Float" searchConditionType="Equal" parameterType="URL" parameterSource="t_ppat_id" logicOperator="And"/>
</UConditions>
<UFormElements>
<CustomParameter id="314" field="t_ppat_id" dataType="Float" parameterType="Control" parameterSource="t_ppat_id" omitIfEmpty="True"/>
<CustomParameter id="315" field="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no" omitIfEmpty="True"/>
<CustomParameter id="316" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
<CustomParameter id="317" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
<CustomParameter id="318" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
<CustomParameter id="319" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
<CustomParameter id="320" field="ppat_name" dataType="Text" parameterType="Control" parameterSource="ppat_name" omitIfEmpty="True"/>
<CustomParameter id="321" field="address_name" dataType="Text" parameterType="Control" parameterSource="address_name" omitIfEmpty="True"/>
<CustomParameter id="322" field="address_no" dataType="Text" parameterType="Control" parameterSource="address_no" omitIfEmpty="True"/>
<CustomParameter id="323" field="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt" omitIfEmpty="True"/>
<CustomParameter id="324" field="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw" omitIfEmpty="True"/>
<CustomParameter id="326" field="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id" omitIfEmpty="True"/>
<CustomParameter id="328" field="p_region_id_kec" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec" omitIfEmpty="True"/>
<CustomParameter id="330" field="wp_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel" omitIfEmpty="True"/>
<CustomParameter id="331" field="identification_no" dataType="Text" parameterType="Control" parameterSource="identification_no" omitIfEmpty="True"/>
<CustomParameter id="332" field="personal_identification_id" dataType="Text" parameterType="Control" parameterSource="personal_identification_id" omitIfEmpty="True"/>
<CustomParameter id="333" field="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no" omitIfEmpty="True"/>
<CustomParameter id="334" field="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no" omitIfEmpty="True"/>
<CustomParameter id="335" field="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code" omitIfEmpty="True"/>
<CustomParameter id="336" field="email_address" dataType="Text" parameterType="Control" parameterSource="email_address" omitIfEmpty="True"/>
</UFormElements>
<DSPParameters/>
<DSQLParameters>
<SQLParameter id="361" variable="t_bphtb_lembar_kendali_id" dataType="Float" parameterType="URL" parameterSource="t_bphtb_lembar_kendali_id" defaultValue="0"/>
</DSQLParameters>
<DConditions>
<TableParameter id="360" conditionType="Parameter" useIsNull="False" field="t_ppat_id" dataType="Float" searchConditionType="Equal" parameterType="URL" parameterSource="t_ppat_id" logicOperator="And"/>
</DConditions>
<SecurityGroups/>
<Attributes/>
<Features/>
</Record>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_bphtb_lembar_kendali_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_bphtb_lembar_kendali.php" forShow="True" url="t_bphtb_lembar_kendali.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
	</Events>
</Page>
