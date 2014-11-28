<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="2" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_bphtb_registrationForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_bphtb_registrationForm" activeCollection="UConditions" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="Table" parameterTypeListName="ParameterTypeList" customUpdateType="Table" customInsertType="Procedure" customDelete="t_bphtb_registration" dataSource="select j.t_bphtb_exemption_id, j.exemption_amount, j.dasar_pengurang, j.analisa_penguranan, j.jenis_pensiunan, j.jenis_perolehan_hak, j.sk_bpn_no, to_char(j.tanggal_sk,'DD-MM-YYYY') as tanggal_sk, 
j.pilihan_lembar_cetak, j.opsi_a2, j.opsi_a2_keterangan, j.opsi_b7, j.opsi_b7_keterangan, j.keterangan_opsi_c, j.keterangan_opsi_c_gono_gini,
to_char(j.tanggal_berita_acara,'DD-MM-YYYY') as tanggal_berita_acara, j.pemeriksa_id, j.administrator_id,
k.pemeriksa_nama as nama_pemeriksa, k.pemeriksa_nip as nip_pemeriksa, k.pemeriksa_jabatan as jabatan_pemeriksa,
l.pemeriksa_nama as nama_operator, l.pemeriksa_nip as nip_operator, l.pemeriksa_jabatan as jabatan_operator,
a.*,
cust_order.p_rqst_type_id,
b.region_name as wp_kota,
c.region_name as wp_kecamatan,
d.region_name as wp_kelurahan,
e.region_name as object_region,
f.region_name as object_kecamatan,
g.region_name as object_kelurahan,
h.description as doc_name

from t_bphtb_exemption as j
left join t_bphtb_registration as a  on j.t_bphtb_registration_id = a.t_bphtb_registration_id
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
left join p_bphtb_legal_doc_type as h
	on a.p_bphtb_legal_doc_type_id = h.p_bphtb_legal_doc_type_id
left join t_customer_order as cust_order
	on cust_order.t_customer_order_id = a.t_customer_order_id
left join t_bphtb_exemption_pemeriksa as k
   on j.pemeriksa_id = k.t_bphtb_exemption_pemeriksa_id
left join t_bphtb_exemption_pemeriksa as l
	on j.administrator_id = l.t_bphtb_exemption_pemeriksa_id
where j.t_customer_order_id = {CURR_DOC_ID}" customUpdate="t_bphtb_registration" activeTableType="customUpdate">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_bphtb_registrationFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_bphtb_registrationFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_bphtb_registrationFormButton_Delete" removeParameters="FLAG;t_vat_registration_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="6" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_bphtb_registrationFormButton_Cancel" returnPage="t_bphtb_registration_list.ccp" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kota" fieldSource="wp_kota" required="True" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_bphtb_registrationFormwp_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kelurahan" fieldSource="wp_kelurahan" required="True" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_bphtb_registrationFormwp_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="10" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormwp_p_region_id" fieldSource="wp_p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="11" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormwp_p_region_id_kec" fieldSource="wp_p_region_id_kec" caption="Kecamatan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="12" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormwp_p_region_id_kel" fieldSource="wp_p_region_id_kel" caption="Kelurahan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kecamatan" caption="Kecamatan - WP" fieldSource="wp_kecamatan" required="True" PathID="t_bphtb_registrationFormwp_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" PathID="t_bphtb_registrationFormwp_name" fieldSource="wp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" PathID="t_bphtb_registrationFormwp_address_name" fieldSource="wp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwp" PathID="t_bphtb_registrationFormnpwp" fieldSource="npwp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kelurahan" fieldSource="object_kelurahan" required="True" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_bphtb_registrationFormobject_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="18" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id_kel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormobject_p_region_id_kel" fieldSource="object_p_region_id_kel" caption="Kelurahan - Object" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kecamatan" caption="Kecamatan - WP" fieldSource="object_kecamatan" required="True" PathID="t_bphtb_registrationFormobject_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="20" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormobject_p_region_id_kec" fieldSource="object_p_region_id_kec" caption="Kecamatan - Object" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="21" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kota" fieldSource="object_region" required="True" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_bphtb_registrationFormobject_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="22" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormobject_p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749" required="True" fieldSource="object_p_region_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="23" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_area" PathID="t_bphtb_registrationFormland_area" defaultValue="0" fieldSource="land_area" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_price_per_m" PathID="t_bphtb_registrationFormland_price_per_m" defaultValue="0" fieldSource="land_price_per_m" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_total_price" PathID="t_bphtb_registrationFormland_total_price" defaultValue="0" fieldSource="land_total_price" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_area" PathID="t_bphtb_registrationFormbuilding_area" defaultValue="0" fieldSource="building_area" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="27" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_price_per_m" PathID="t_bphtb_registrationFormbuilding_price_per_m" defaultValue="0" fieldSource="building_price_per_m" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_total_price" PathID="t_bphtb_registrationFormbuilding_total_price" defaultValue="0" fieldSource="building_total_price" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_rt" PathID="t_bphtb_registrationFormwp_rt" fieldSource="wp_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_rw" PathID="t_bphtb_registrationFormwp_rw" fieldSource="wp_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_rt" PathID="t_bphtb_registrationFormobject_rt" fieldSource="object_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="32" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_rw" PathID="t_bphtb_registrationFormobject_rw" fieldSource="object_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="njop_pbb" PathID="t_bphtb_registrationFormnjop_pbb" fieldSource="njop_pbb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="34" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_address_name" PathID="t_bphtb_registrationFormobject_address_name" fieldSource="object_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="npop" PathID="t_bphtb_registrationFormnpop" fieldSource="npop" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="36" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="npop_tkp" PathID="t_bphtb_registrationFormnpop_tkp" fieldSource="npop_tkp" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="npop_kp" PathID="t_bphtb_registrationFormnpop_kp" fieldSource="npop_kp" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="bphtb_amt" PathID="t_bphtb_registrationFormbphtb_amt" fieldSource="bphtb_amt" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="39" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="bphtb_amt_final" PathID="t_bphtb_registrationFormbphtb_amt_final" fieldSource="bphtb_amt_final" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="bphtb_discount" PathID="t_bphtb_registrationFormbphtb_discount" fieldSource="bphtb_discount" format="#,##" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" PathID="t_bphtb_registrationFormdescription" fieldSource="description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="42" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="market_price" PathID="t_bphtb_registrationFormmarket_price" fieldSource="market_price" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no" PathID="t_bphtb_registrationFormphone_no" fieldSource="phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_phone_no" PathID="t_bphtb_registrationFormmobile_phone_no" fieldSource="mobile_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="45" visible="Yes" fieldSourceType="CodeExpression" dataType="Float" name="total_price" PathID="t_bphtb_registrationFormtotal_price" defaultValue="0" fieldSource="$this-&gt;DataSource-&gt;land_total_price-&gt;GetValue()+$this-&gt;DataSource-&gt;building_total_price-&gt;GetValue()" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="46" fieldSourceType="DBColumn" dataType="Integer" name="t_bphtb_registration_id" PathID="t_bphtb_registrationFormt_bphtb_registration_id" fieldSource="t_bphtb_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="47" fieldSourceType="DBColumn" dataType="Text" name="TAKEN_CTL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormTAKEN_CTL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="48" fieldSourceType="DBColumn" dataType="Text" name="IS_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormIS_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="49" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormCURR_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="50" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormCURR_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="51" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormCURR_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="52" fieldSourceType="DBColumn" dataType="Text" name="CURR_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormCURR_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="53" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormUSER_ID_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="54" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DONOR" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormUSER_ID_DONOR">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="55" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_LOGIN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormUSER_ID_LOGIN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="56" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormUSER_ID_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="57" fieldSourceType="DBColumn" dataType="Text" name="IS_CREATE_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormIS_CREATE_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="58" fieldSourceType="DBColumn" dataType="Text" name="IS_MANUAL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormIS_MANUAL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="59" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormCURR_PROC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="60" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormCURR_DOC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="61" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormPREV_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="62" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormPREV_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="63" fieldSourceType="DBColumn" dataType="Text" name="PREV_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormPREV_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="64" fieldSourceType="DBColumn" dataType="Text" name="PREV_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormPREV_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="65" fieldSourceType="DBColumn" dataType="Text" name="SLOT_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormSLOT_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="66" fieldSourceType="DBColumn" dataType="Text" name="SLOT_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormSLOT_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="67" fieldSourceType="DBColumn" dataType="Text" name="SLOT_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormSLOT_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="68" fieldSourceType="DBColumn" dataType="Text" name="SLOT_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormSLOT_4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="69" fieldSourceType="DBColumn" dataType="Text" name="SLOT_5" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormSLOT_5">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="70" fieldSourceType="DBColumn" dataType="Text" name="MESSAGE" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormMESSAGE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="71" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormButton2">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="72" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="73" urlType="Relative" enableValidation="True" isDefault="False" name="Button3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormButton3">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="74" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="75" visible="Dynamic" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" returnValueType="Number" name="p_bphtb_legal_doc_type_id" fieldSource="p_bphtb_legal_doc_type_id" connection="ConnSIKP" dataSource="select p_bphtb_legal_doc_type_id,code
from p_bphtb_legal_doc_type bphtb_legal
left join p_legal_doc_type legal on legal.p_legal_doc_type_id = bphtb_legal.p_legal_doc_type_id
" boundColumn="p_bphtb_legal_doc_type_id" textColumn="code" features="(assigned)" PathID="t_bphtb_registrationFormp_bphtb_legal_doc_type_id">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="76" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features>
						<PTAutoFill id="131" enabled="True" sourceType="SQL" name="PTAutoFill1" category="Prototype" featureNameChanged="No" connection="ConnSIKP" dataSource="select p_bphtb_legal_doc_type_id,code
from p_bphtb_legal_doc_type bphtb_legal
left join p_legal_doc_type legal on legal.p_legal_doc_type_id = bphtb_legal.p_legal_doc_type_id
" ccsIdsOnly="False" valueField="value" servicePage="../services/trans_t_bphtb_registration_t_bphtb_registrationForm_p_bphtb_legal_doc_type_id_PTAutoFill1.ccp">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Controls>
								<Control id="132" name="npop_tkp" source="npop_tkp" propertyValue="value" sourceId="36"/>
							</Controls>
							<ControlPoints/>
							<Features/>
						</PTAutoFill>
					</Features>
				</ListBox>
				<Hidden id="133" fieldSourceType="DBColumn" dataType="Text" name="t_customer_order_id" PathID="t_bphtb_registrationFormt_customer_order_id" fieldSource="t_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="134" fieldSourceType="DBColumn" dataType="Text" name="p_rqst_type_id" PathID="t_bphtb_registrationFormp_rqst_type_id" fieldSource="p_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="137" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="registration_no" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormregistration_no" fieldSource="registration_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="142" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="jenis_harga_bphtb" wizardEmptyCaption="Select Value" PathID="t_bphtb_registrationFormjenis_harga_bphtb" connection="ConnSIKP" _valueOfList="3" _nameOfList="Harga Lelang" dataSource="1;Harga Transaksi;2;Harga Pasar;3;Harga Lelang" fieldSource="jenis_harga_bphtb">
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
				<TextBox id="143" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="bphtb_legal_doc_description" PathID="t_bphtb_registrationFormbphtb_legal_doc_description" fieldSource="bphtb_legal_doc_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="144" fieldSourceType="DBColumn" dataType="Text" name="nilai_doc" PathID="t_bphtb_registrationFormnilai_doc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="145" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="add_disc_percent" wizardEmptyCaption="Select Value" PathID="t_bphtb_registrationFormadd_disc_percent" connection="ConnSIKP" _valueOfList="0.75" _nameOfList="75%" dataSource="0;0%;0.25;25%;0.5;50%;0.75;75%;1;100%" fieldSource="add_disc_percent">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="146"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="147" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="add_discount" PathID="t_bphtb_registrationFormadd_discount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="150" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="p_bphtb_type_id" PathID="t_bphtb_registrationFormp_bphtb_type_id" fieldSource="p_bphtb_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="192" fieldSourceType="DBColumn" dataType="Integer" name="t_bphtb_exemption_id" PathID="t_bphtb_registrationFormt_bphtb_exemption_id" fieldSource="t_bphtb_exemption_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="202" urlType="Relative" enableValidation="True" isDefault="False" name="Button4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormButton4">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="203" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="206" urlType="Relative" enableValidation="True" isDefault="False" name="Button6" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormButton6">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="207" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="209" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="pilihan_lembar_cetak" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_bphtb_registrationFormpilihan_lembar_cetak" connection="ConnSIKP" _valueOfList="6" _nameOfList="Peralihan Hak Baru" dataSource="1;Waris;2;Fasos;3;Rumah Dinas;4;Waris Gono-Gini;5;Hibah;6;Peralihan Hak Baru" fieldSource="pilihan_lembar_cetak" required="True">
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
				<ListBox id="210" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="opsi_a2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_bphtb_registrationFormopsi_a2" connection="ConnSIKP" _valueOfList="6" _nameOfList="Peralihan Hak Baru" fieldSource="opsi_a2">
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
				<Hidden id="211" fieldSourceType="DBColumn" dataType="Text" name="a2_val" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationForma2_val" fieldSource="opsi_a2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="212" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="opsi_a2_keterangan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormopsi_a2_keterangan" fieldSource="opsi_a2_keterangan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="213" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="opsi_b7" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_bphtb_registrationFormopsi_b7" connection="ConnSIKP" _valueOfList="6" _nameOfList="Peralihan Hak Baru" fieldSource="opsi_b7">
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
				<Hidden id="214" fieldSourceType="DBColumn" dataType="Text" name="b7_val" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormb7_val" fieldSource="opsi_b7">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="215" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="opsi_b7_keterangan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormopsi_b7_keterangan" fieldSource="opsi_b7_keterangan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="198" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tanggal_sk" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormtanggal_sk" fieldSource="tanggal_sk" format="dd-mm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="199" name="DatePicker_tanggal_sk1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormDatePicker_tanggal_sk1" control="tanggal_sk" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextArea id="200" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="dasar_pengurang" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormdasar_pengurang" fieldSource="dasar_pengurang">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="201" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="analisa_penguranan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormanalisa_penguranan" fieldSource="analisa_penguranan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="216" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="keterangan_opsi_c" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormketerangan_opsi_c" fieldSource="keterangan_opsi_c">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="217" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="keterangan_opsi_c_gono_gini" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormketerangan_opsi_c_gono_gini" fieldSource="keterangan_opsi_c_gono_gini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Button id="204" urlType="Relative" enableValidation="True" isDefault="False" name="Button5" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormButton5">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="205" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="220" urlType="Relative" enableValidation="True" isDefault="False" name="Button7" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormButton7">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="221" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="222" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" returnValueType="Number" name="administrator_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_bphtb_registrationFormadministrator_id" fieldSource="administrator_id" connection="ConnSIKP" dataSource="SELECT * FROM t_bphtb_exemption_pemeriksa
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
<ListBox id="223" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" returnValueType="Number" name="pemeriksa_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_bphtb_registrationFormpemeriksa_id" fieldSource="pemeriksa_id" connection="ConnSIKP" dataSource="SELECT * FROM t_bphtb_exemption_pemeriksa
WHERE pemeriksa_status = 'pemeriksa'"><Components/>
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
<TextBox id="218" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tanggal_berita_acara" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormtanggal_berita_acara" fieldSource="tanggal_berita_acara" format="dd-mm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<DatePicker id="219" name="DatePicker_tanggal_berita_acara1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormDatePicker_tanggal_berita_acara1" control="tanggal_berita_acara" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="77" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="78" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="79" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="140"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="141"/>
					</Actions>
				</Event>
				<Event name="BeforeExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="191"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="80" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_customer_order_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="81" variable="CURR_DOC_ID" parameterType="URL" dataType="Float" parameterSource="CURR_DOC_ID" defaultValue="0" designDefaultValue="505"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters>
				<SPParameter id="Key944" parameterName="wp_name" parameterSource="wp_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="0" precision="0" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key945" parameterName="npwp" parameterSource="npwp" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="0" precision="0" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key946" parameterName="wp_address_name" parameterSource="wp_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="0" precision="0" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key947" parameterName="wp_rt" parameterSource="wp_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="0" precision="0" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key948" parameterName="wp_rw" parameterSource="wp_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="0" precision="0" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key949" parameterName="wp_p_region_id" parameterSource="wp_p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key950" parameterName="wp_p_region_id_kec" parameterSource="wp_p_region_id_kecamatan" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key951" parameterName="wp_p_region_id_kel" parameterSource="wp_p_region_id_kelurahan" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key952" parameterName="phone_no" parameterSource="phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key953" parameterName="mobile_phone_no" parameterSource="mobile_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key954" parameterName="njop_pbb" parameterSource="njop_pbb" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key955" parameterName="object_address_name" parameterSource="object_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key956" parameterName="object_rt" parameterSource="object_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key957" parameterName="object_rw" parameterSource="object_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key958" parameterName="object_p_region_id" parameterSource="object_p_region_id" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key959" parameterName="object_p_region_id_kec" parameterSource="object_p_region_id_kecamatan" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key960" parameterName="object_p_region_id_kel" parameterSource="object_p_region_id_kelurahan" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key961" parameterName="p_bphtb_legal_doc_type_id" parameterSource="p_bphtb_legal_doc_type_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key962" parameterName="land_area" parameterSource="land_area" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key963" parameterName="land_price_per_m" parameterSource="land_price_per_m" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key964" parameterName="land_total_price" parameterSource="land_total_price" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key965" parameterName="building_area" parameterSource="building_area" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key966" parameterName="building_price_per_m" parameterSource="building_price_per_m" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key967" parameterName="building_total_price" parameterSource="building_total_price" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key968" parameterName="market_price" parameterSource="market_price" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key969" parameterName="npop" parameterSource="npop" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key970" parameterName="npop_tkp" parameterSource="npop_tkp" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key971" parameterName="npop_kp" parameterSource="npop_kp" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key972" parameterName="bphtb_amt" parameterSource="bphtb_amt" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key973" parameterName="bphtb_discount" parameterSource="bphtb_discount" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key974" parameterName="bphtb_amt_final" parameterSource="bphtb_amt_final" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key975" parameterName="description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key976" parameterName="i_user" parameterSource="UserLogin" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key977" parameterName="o_t_bphtb_registration_id" parameterSource="o_t_bphtb_registration_id" dataType="Numeric" parameterType="URL" dataSize="0" direction="InputOutput" scale="10" precision="6"/>
				<SPParameter id="Key978" parameterName="o_mess" parameterSource="o_mess" dataType="Char" parameterType="URL" dataSize="255" direction="InputOutput" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="82" field="wp_kota" dataType="Text" parameterType="Control" parameterSource="wp_kota"/>
				<CustomParameter id="83" field="wp_kelurahan" dataType="Text" parameterType="Control" parameterSource="wp_kelurahan"/>
				<CustomParameter id="84" field="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id"/>
				<CustomParameter id="85" field="wp_p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kecamatan"/>
				<CustomParameter id="86" field="wp_p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kelurahan"/>
				<CustomParameter id="87" field="wp_kecamatan" dataType="Text" parameterType="Control" parameterSource="wp_kecamatan"/>
				<CustomParameter id="88" field="wp_kelurahan" dataType="Text" parameterType="Control" parameterSource="object_kelurahan"/>
				<CustomParameter id="89" field="wp_p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="object_p_region_id_kelurahan"/>
				<CustomParameter id="90" field="wp_kecamatan" dataType="Text" parameterType="Control" parameterSource="object_kecamatan"/>
				<CustomParameter id="91" field="wp_p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="object_p_region_id_kecamatan"/>
				<CustomParameter id="92" field="wp_kota" dataType="Text" parameterType="Control" parameterSource="object_kota"/>
				<CustomParameter id="93" field="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="object_p_region_id"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key905" dataType="Char" parameterType="URL" dataSize="255" direction="ReturnValue" scale="0" precision="0" parameterName="o_res" parameterSource="o_res"/>
				<SPParameter id="Key906" parameterName="icode" parameterSource="icode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="0" precision="0"/>
				<SPParameter id="Key907" parameterName="iuser" parameterSource="CCGetUserLogin()" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key908" parameterName="cusorderid" parameterSource="t_customer_order_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key909" parameterName="regionidkel" parameterSource="p_region_id_kelurahan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key910" parameterName="regionidkec" parameterSource="p_region_id_kecamatan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key911" parameterName="regionid" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key912" parameterName="regionidkelown" parameterSource="p_region_id_kel_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key913" parameterName="regionidkecown" parameterSource="p_region_id_kec_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key914" parameterName="regionidown" parameterSource="p_region_id_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key915" parameterName="companyname" parameterSource="company_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key916" parameterName="addressname" parameterSource="address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key917" parameterName="jobid" parameterSource="p_job_position_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key918" parameterName="companybrand" parameterSource="company_brand" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key919" parameterName="addressno" parameterSource="address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key920" parameterName="addressrt" parameterSource="address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key921" parameterName="addressrw" parameterSource="address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key922" parameterName="addressnoown" parameterSource="address_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key923" parameterName="addressrtown" parameterSource="address_rt_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key924" parameterName="addressrwown" parameterSource="address_rw_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key925" parameterName="phoneno" parameterSource="phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key926" parameterName="faxno" parameterSource="fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key927" parameterName="zipcode" parameterSource="zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key928" parameterName="phonenoown" parameterSource="phone_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key929" parameterName="companyown" parameterSource="company_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key930" parameterName="mobilenoown" parameterSource="mobile_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key931" parameterName="faxnoown" parameterSource="fax_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key932" parameterName="zipcodeown" parameterSource="zip_code_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key933" parameterName="mobileno" parameterSource="mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key934" parameterName="addressnameown" parameterSource="address_name_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key935" parameterName="i_email" parameterSource="email" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key940" parameterName="vattypedtlid" parameterSource="p_vat_type_dtl_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key941" parameterName="wpusername" parameterSource="wp_user_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key942" parameterName="wpuserpwd" parameterSource="wp_user_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key943" parameterName="wpname" parameterSource="wp_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key944" parameterName="wpaddressname" parameterSource="wp_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key945" parameterName="wpaddressno" parameterSource="wp_address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key946" parameterName="wprt" parameterSource="wp_address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key947" parameterName="wprw" parameterSource="wp_address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key948" parameterName="wpkel" parameterSource="wp_p_region_id_kelurahan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key949" parameterName="wpkec" parameterSource="wp_p_region_id_kecamatan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key950" parameterName="wpkota" parameterSource="wp_p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key951" parameterName="wpphoneno" parameterSource="wp_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key952" parameterName="wpmobileno" parameterSource="wp_mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key953" parameterName="wpfaxno" parameterSource="wp_fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key954" parameterName="wpzipcode" parameterSource="wp_zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key955" parameterName="wpemail" parameterSource="wp_email" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key956" parameterName="brandaddress" parameterSource="brand_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key957" parameterName="brandno" parameterSource="brand_address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key958" parameterName="brandrt" parameterSource="brand_address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key959" parameterName="brandrw" parameterSource="brand_address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key960" parameterName="brandkel" parameterSource="brand_p_region_id_kel" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key961" parameterName="brandkec" parameterSource="brand_p_region_id_kec" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key962" parameterName="brandkota" parameterSource="brand_p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key963" parameterName="brandphoneno" parameterSource="brand_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key964" parameterName="brandmobileno" parameterSource="brand_mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key965" parameterName="brandfaxno" parameterSource="brand_fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key966" parameterName="brandzipcode" parameterSource="brand_zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key967" parameterName="idvat" parameterSource="t_vat_registration_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key968" parameterName="questionid" parameterSource="p_private_question_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key969" parameterName="privateanswer" parameterSource="private_answer" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key970" parameterName="i_mode" parameterSource="'U'" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
				<SQLParameter id="153" variable="UserLogin" dataType="Text" parameterType="Session" parameterSource="UserLogin"/>
				<SQLParameter id="154" variable="Expr0" dataType="Text" parameterType="Expression" parameterSource="date(&quot;Y-m-d H:i:s&quot;)" format="dd-mmm-yyyy"/>
				<SQLParameter id="155" variable="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id"/>
				<SQLParameter id="156" variable="wp_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kel"/>
				<SQLParameter id="157" variable="wp_name" dataType="Text" parameterType="Control" parameterSource="wp_name"/>
				<SQLParameter id="158" variable="wp_address_name" dataType="Text" parameterType="Control" parameterSource="wp_address_name"/>
				<SQLParameter id="159" variable="npwp" dataType="Text" parameterType="Control" parameterSource="npwp"/>
				<SQLParameter id="160" variable="object_p_region_id_kec" dataType="Text" parameterType="Control" parameterSource="object_p_region_id_kec"/>
				<SQLParameter id="161" variable="object_p_region_id" dataType="Text" parameterType="Control" parameterSource="object_p_region_id"/>
				<SQLParameter id="162" variable="land_area" dataType="Float" parameterType="Control" parameterSource="land_area"/>
				<SQLParameter id="163" variable="land_price_per_m" dataType="Float" parameterType="Control" parameterSource="land_price_per_m"/>
				<SQLParameter id="164" variable="land_total_price" dataType="Float" parameterType="Control" parameterSource="land_total_price"/>
				<SQLParameter id="165" variable="building_area" dataType="Float" parameterType="Control" parameterSource="building_area"/>
				<SQLParameter id="166" variable="building_price_per_m" dataType="Float" parameterType="Control" parameterSource="building_price_per_m"/>
				<SQLParameter id="167" variable="building_total_price" dataType="Float" parameterType="Control" parameterSource="building_total_price"/>
				<SQLParameter id="168" variable="wp_rt" dataType="Text" parameterType="Control" parameterSource="wp_rt"/>
				<SQLParameter id="169" variable="wp_rw" dataType="Text" parameterType="Control" parameterSource="wp_rw"/>
				<SQLParameter id="170" variable="object_rt" dataType="Text" parameterType="Control" parameterSource="object_rt"/>
				<SQLParameter id="171" variable="object_rw" dataType="Text" parameterType="Control" parameterSource="object_rw"/>
				<SQLParameter id="172" variable="njop_pbb" dataType="Text" parameterType="Control" parameterSource="njop_pbb"/>
				<SQLParameter id="173" variable="object_address_name" dataType="Text" parameterType="Control" parameterSource="object_address_name"/>
				<SQLParameter id="174" variable="p_bphtb_legal_doc_type_id" dataType="Text" parameterType="Control" parameterSource="p_bphtb_legal_doc_type_id"/>
				<SQLParameter id="175" variable="npop" dataType="Float" parameterType="Control" parameterSource="npop"/>
				<SQLParameter id="176" variable="npop_tkp" dataType="Float" parameterType="Control" parameterSource="npop_tkp"/>
				<SQLParameter id="177" variable="npop_kp" dataType="Float" parameterType="Control" parameterSource="npop_kp"/>
				<SQLParameter id="178" variable="bphtb_amt" dataType="Float" parameterType="Control" parameterSource="bphtb_amt"/>
				<SQLParameter id="179" variable="bphtb_amt_final" dataType="Float" parameterType="Control" parameterSource="bphtb_amt_final"/>
				<SQLParameter id="180" variable="bphtb_discount" dataType="Float" parameterType="Control" parameterSource="bphtb_discount"/>
				<SQLParameter id="181" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="182" variable="market_price" dataType="Float" parameterType="Control" parameterSource="market_price"/>
				<SQLParameter id="183" variable="mobile_phone_no" dataType="Text" parameterType="Control" parameterSource="mobile_phone_no"/>
				<SQLParameter id="184" variable="wp_p_region_id_kec" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kec"/>
				<SQLParameter id="185" variable="object_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="object_p_region_id_kel"/>
				<SQLParameter id="186" variable="verificated_by" dataType="Text" parameterType="Control" parameterSource="verificated_by"/>
				<SQLParameter id="187" variable="verificated_nip" dataType="Text" parameterType="Control" parameterSource="verificated_nip"/>
				<SQLParameter id="188" variable="bphtb_legal_doc_description" dataType="Text" parameterType="Control" parameterSource="bphtb_legal_doc_description"/>
				<SQLParameter id="189" variable="add_disc_percent" dataType="Float" parameterType="Control" parameterSource="add_disc_percent"/>
				<SQLParameter id="190" variable="t_bphtb_registration_id" parameterType="URL" dataType="Float" parameterSource="t_bphtb_registration_id" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="94" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
				<TableParameter id="95" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
				<TableParameter id="96" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="97" field="updated_by" dataType="Text" parameterType="Session" parameterSource="UserLogin" omitIfEmpty="True"/>
				<CustomParameter id="98" field="updated_date" dataType="Text" parameterType="Expression" parameterSource="date(&quot;Y-m-d H:i:s&quot;)" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="99" field="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id" omitIfEmpty="True"/>
				<CustomParameter id="100" field="wp_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kel" omitIfEmpty="True"/>
				<CustomParameter id="101" field="wp_name" dataType="Text" parameterType="Control" parameterSource="wp_name" omitIfEmpty="True"/>
				<CustomParameter id="102" field="wp_address_name" dataType="Text" parameterType="Control" parameterSource="wp_address_name" omitIfEmpty="True"/>
				<CustomParameter id="103" field="npwp" dataType="Text" parameterType="Control" parameterSource="npwp" omitIfEmpty="True"/>
				<CustomParameter id="104" field="object_p_region_id_kec" dataType="Text" parameterType="Control" parameterSource="object_p_region_id_kec" omitIfEmpty="True"/>
				<CustomParameter id="105" field="object_p_region_id" dataType="Text" parameterType="Control" parameterSource="object_p_region_id" omitIfEmpty="True"/>
				<CustomParameter id="106" field="land_area" dataType="Float" parameterType="Control" parameterSource="land_area" omitIfEmpty="True"/>
				<CustomParameter id="107" field="land_price_per_m" dataType="Float" parameterType="Control" parameterSource="land_price_per_m" omitIfEmpty="True"/>
				<CustomParameter id="108" field="land_total_price" dataType="Float" parameterType="Control" parameterSource="land_total_price" omitIfEmpty="True"/>
				<CustomParameter id="109" field="building_area" dataType="Float" parameterType="Control" parameterSource="building_area" omitIfEmpty="True"/>
				<CustomParameter id="110" field="building_price_per_m" dataType="Float" parameterType="Control" parameterSource="building_price_per_m" omitIfEmpty="True"/>
				<CustomParameter id="111" field="building_total_price" dataType="Float" parameterType="Control" parameterSource="building_total_price" omitIfEmpty="True"/>
				<CustomParameter id="112" field="wp_rt" dataType="Text" parameterType="Control" parameterSource="wp_rt" omitIfEmpty="True"/>
				<CustomParameter id="113" field="wp_rw" dataType="Text" parameterType="Control" parameterSource="wp_rw" omitIfEmpty="True"/>
				<CustomParameter id="114" field="object_rt" dataType="Text" parameterType="Control" parameterSource="object_rt" omitIfEmpty="True"/>
				<CustomParameter id="115" field="object_rw" dataType="Text" parameterType="Control" parameterSource="object_rw" omitIfEmpty="True"/>
				<CustomParameter id="116" field="njop_pbb" dataType="Text" parameterType="Control" parameterSource="njop_pbb" omitIfEmpty="True"/>
				<CustomParameter id="117" field="object_address_name" dataType="Text" parameterType="Control" parameterSource="object_address_name" omitIfEmpty="True"/>
				<CustomParameter id="118" field="p_bphtb_legal_doc_type_id" dataType="Text" parameterType="Control" parameterSource="p_bphtb_legal_doc_type_id" omitIfEmpty="True"/>
				<CustomParameter id="119" field="npop" dataType="Float" parameterType="Control" parameterSource="npop" omitIfEmpty="True"/>
				<CustomParameter id="120" field="npop_tkp" dataType="Float" parameterType="Control" parameterSource="npop_tkp" omitIfEmpty="True"/>
				<CustomParameter id="121" field="npop_kp" dataType="Float" parameterType="Control" parameterSource="npop_kp" omitIfEmpty="True"/>
				<CustomParameter id="122" field="bphtb_amt" dataType="Float" parameterType="Control" parameterSource="bphtb_amt" omitIfEmpty="True"/>
				<CustomParameter id="123" field="bphtb_amt_final" dataType="Float" parameterType="Control" parameterSource="bphtb_amt_final" omitIfEmpty="True"/>
				<CustomParameter id="124" field="bphtb_discount" dataType="Float" parameterType="Control" parameterSource="bphtb_discount" omitIfEmpty="True"/>
				<CustomParameter id="125" field="description" dataType="Text" parameterType="Control" parameterSource="description" omitIfEmpty="True"/>
				<CustomParameter id="126" field="market_price" dataType="Float" parameterType="Control" parameterSource="market_price" omitIfEmpty="True"/>
				<CustomParameter id="127" field="mobile_phone_no" dataType="Text" parameterType="Control" parameterSource="mobile_phone_no" omitIfEmpty="True"/>
				<CustomParameter id="128" field="wp_p_region_id_kec" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="wp_p_region_id_kec"/>
				<CustomParameter id="129" field="object_p_region_id_kel" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="object_p_region_id_kel"/>
				<CustomParameter id="148" field="bphtb_legal_doc_description" dataType="Text" parameterType="Control" omitIfEmpty="True" parameterSource="bphtb_legal_doc_description"/>
				<CustomParameter id="149" field="add_disc_percent" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="add_disc_percent"/>
			</UFormElements>
			<DSPParameters>
				<SPParameter id="Key905" dataType="Char" parameterType="URL" dataSize="255" direction="ReturnValue" scale="0" precision="0"/>
				<SPParameter id="Key906" parameterName="icode" parameterSource="icode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="0" precision="0"/>
				<SPParameter id="Key907" parameterName="iuser" parameterSource="iuser" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="0" precision="0"/>
				<SPParameter id="Key908" parameterName="cusorderid" parameterSource="cusorderid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key909" parameterName="regionidkel" parameterSource="regionidkel" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key910" parameterName="regionidkec" parameterSource="regionidkec" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key911" parameterName="regionid" parameterSource="regionid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key912" parameterName="regionidkelown" parameterSource="regionidkelown" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key913" parameterName="regionidkecown" parameterSource="regionidkecown" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key914" parameterName="regionidown" parameterSource="regionidown" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key915" parameterName="companyname" parameterSource="companyname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key916" parameterName="addressname" parameterSource="addressname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key917" parameterName="jobid" parameterSource="jobid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key918" parameterName="companybrand" parameterSource="companybrand" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key919" parameterName="addressno" parameterSource="addressno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key920" parameterName="addressrt" parameterSource="addressrt" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key921" parameterName="addressrw" parameterSource="addressrw" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key922" parameterName="addressnoown" parameterSource="addressnoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key923" parameterName="addressrtown" parameterSource="addressrtown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key924" parameterName="addressrwown" parameterSource="addressrwown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key925" parameterName="phoneno" parameterSource="phoneno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key926" parameterName="faxno" parameterSource="faxno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key927" parameterName="zipcode" parameterSource="zipcode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key928" parameterName="phonenoown" parameterSource="phonenoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key929" parameterName="companyown" parameterSource="companyown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key930" parameterName="mobilenoown" parameterSource="mobilenoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key931" parameterName="faxnoown" parameterSource="faxnoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key932" parameterName="zipcodeown" parameterSource="zipcodeown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key933" parameterName="mobileno" parameterSource="mobileno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key934" parameterName="addressnameown" parameterSource="addressnameown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key935" parameterName="i_email" parameterSource="i_email" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key940" parameterName="vattypedtlid" parameterSource="vattypedtlid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key941" parameterName="wpusername" parameterSource="wpusername" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key942" parameterName="wpuserpwd" parameterSource="wpuserpwd" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key943" parameterName="wpname" parameterSource="wpname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key944" parameterName="wpaddressname" parameterSource="wpaddressname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key945" parameterName="wpaddressno" parameterSource="wpaddressno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key946" parameterName="wprt" parameterSource="wprt" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key947" parameterName="wprw" parameterSource="wprw" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key948" parameterName="wpkel" parameterSource="wpkel" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key949" parameterName="wpkec" parameterSource="wpkec" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key950" parameterName="wpkota" parameterSource="wpkota" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key951" parameterName="wpphoneno" parameterSource="wpphoneno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key952" parameterName="wpmobileno" parameterSource="wpmobileno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key953" parameterName="wpfaxno" parameterSource="wpfaxno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key954" parameterName="wpzipcode" parameterSource="wpzipcode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key955" parameterName="wpemail" parameterSource="wpemail" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key956" parameterName="brandaddress" parameterSource="brandaddress" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key957" parameterName="brandno" parameterSource="brandno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key958" parameterName="brandrt" parameterSource="brandrt" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key959" parameterName="brandrw" parameterSource="brandrw" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key960" parameterName="brandkel" parameterSource="brandkel" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key961" parameterName="brandkec" parameterSource="brandkec" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key962" parameterName="brandkota" parameterSource="brandkota" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key963" parameterName="brandphoneno" parameterSource="brandphoneno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key964" parameterName="brandmobileno" parameterSource="brandmobileno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key965" parameterName="brandfaxno" parameterSource="brandfaxno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key966" parameterName="brandzipcode" parameterSource="brandzipcode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key967" parameterName="idvat" parameterSource="t_vat_registration_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key968" parameterName="questionid" parameterSource="questionid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key969" parameterName="privateanswer" parameterSource="privateanswer" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key970" parameterName="i_mode" parameterSource="'D'" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
			</DSPParameters>
			<DSQLParameters>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="130" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_bphtb_registration_pengurangan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_bphtb_registration_pengurangan.php" forShow="True" url="t_bphtb_registration_pengurangan.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
	</Events>
</Page>
