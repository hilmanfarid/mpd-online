<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_bphtb_registrationForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_bphtb_registrationForm" activeCollection="UFormElements" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="Table" parameterTypeListName="ParameterTypeList" customUpdateType="Table" customInsertType="Procedure" customDelete="t_bphtb_registration" customInsert="f_bphtb_registration" dataSource="select a.*,
b.region_name as wp_kota,
c.region_name as wp_kecamatan,
d.region_name as wp_kelurahan,
e.region_name as object_region,
f.region_name as object_kecamatan,
g.region_name as object_kelurahan,
h.description as doc_name,
(a.bphtb_amt - a.bphtb_discount) AS bphtb_amt_final_old,
j.payment_vat_amount AS prev_payment_amount

from t_bphtb_registration as a 
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
left join t_bphtb_registration as i
	on a.registration_no_ref = i.registration_no
left join t_payment_receipt_bphtb as j
	on i.t_bphtb_registration_id = j.t_bphtb_registration_id
where a.t_bphtb_registration_id = {t_bphtb_registration_id}" customUpdate="t_bphtb_registration" activeTableType="t_bphtb_registration" returnPage="t_bphtb_registration_list.ccp">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_bphtb_registrationFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_bphtb_registrationFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_bphtb_registrationFormButton_Delete" removeParameters="FLAG;t_vat_registration_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="98" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_bphtb_registrationFormButton_Cancel" returnPage="t_bphtb_registration_list.ccp" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="869" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kota" fieldSource="wp_kota" required="True" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_bphtb_registrationFormwp_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="871" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kelurahan" fieldSource="wp_kelurahan" required="True" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_bphtb_registrationFormwp_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="885" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormwp_p_region_id" fieldSource="wp_p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="887" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormwp_p_region_id_kec" fieldSource="wp_p_region_id_kec" caption="Kecamatan - WP" required="True">
					<Components/>
					<Events/>

					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="889" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormwp_p_region_id_kel" fieldSource="wp_p_region_id_kel" caption="Kelurahan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="870" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kecamatan" caption="Kecamatan - WP" fieldSource="wp_kecamatan" required="True" PathID="t_bphtb_registrationFormwp_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="898" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" PathID="t_bphtb_registrationFormwp_name" fieldSource="wp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="899" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" PathID="t_bphtb_registrationFormwp_address_name" fieldSource="wp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="900" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwp" PathID="t_bphtb_registrationFormnpwp" fieldSource="npwp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="901" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kelurahan" fieldSource="object_kelurahan" required="True" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_bphtb_registrationFormobject_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="903" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id_kel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormobject_p_region_id_kel" fieldSource="object_p_region_id_kel" caption="Kelurahan - Object" required="True" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="904" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kecamatan" caption="Kecamatan - WP" fieldSource="object_kecamatan" required="True" PathID="t_bphtb_registrationFormobject_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="906" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormobject_p_region_id_kec" fieldSource="object_p_region_id_kec" caption="Kecamatan - Object" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="907" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kota" fieldSource="object_region" required="True" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_bphtb_registrationFormobject_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="909" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormobject_p_region_id" fieldSource="object_p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="922" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_area" PathID="t_bphtb_registrationFormland_area" defaultValue="0" fieldSource="land_area" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="923" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_price_per_m" PathID="t_bphtb_registrationFormland_price_per_m" defaultValue="0" fieldSource="land_price_per_m" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="924" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_total_price" PathID="t_bphtb_registrationFormland_total_price" defaultValue="0" fieldSource="land_total_price" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="925" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_area" PathID="t_bphtb_registrationFormbuilding_area" defaultValue="0" fieldSource="building_area" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="926" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_price_per_m" PathID="t_bphtb_registrationFormbuilding_price_per_m" defaultValue="0" fieldSource="building_price_per_m" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="927" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_total_price" PathID="t_bphtb_registrationFormbuilding_total_price" defaultValue="0" fieldSource="building_total_price" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="928" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_rt" PathID="t_bphtb_registrationFormwp_rt" fieldSource="wp_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="929" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_rw" PathID="t_bphtb_registrationFormwp_rw" fieldSource="wp_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="930" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_rt" PathID="t_bphtb_registrationFormobject_rt" fieldSource="object_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="931" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_rw" PathID="t_bphtb_registrationFormobject_rw" fieldSource="object_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="932" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="njop_pbb" PathID="t_bphtb_registrationFormnjop_pbb" fieldSource="njop_pbb">
					<Components/>
					<Events>
<Event name="OnChange" type="Client">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="1064"/>
</Actions>
</Event>
</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="933" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_address_name" PathID="t_bphtb_registrationFormobject_address_name" fieldSource="object_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="934" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="p_bphtb_legal_doc_type_id" PathID="t_bphtb_registrationFormp_bphtb_legal_doc_type_id" sourceType="SQL" connection="ConnSIKP" dataSource="select p_bphtb_legal_doc_type_id,code
from p_bphtb_legal_doc_type bphtb_legal
left join p_legal_doc_type legal on legal.p_legal_doc_type_id = bphtb_legal.p_legal_doc_type_id
" boundColumn="p_bphtb_legal_doc_type_id" textColumn="code" features="(assigned)" fieldSource="p_bphtb_legal_doc_type_id">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="956" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features>
						<PTAutoFill id="951" enabled="True" valueField="value" sourceType="Table" name="PTAutoFill1" servicePage="../services/trans_t_bphtb_registration_t_bphtb_registrationForm_p_bphtb_legal_doc_type_id_PTAutoFill1.ccp" searchField="p_bphtb_legal_doc_type_id" connection="ConnSIKP" featureNameChanged="No" dataSource="p_bphtb_legal_doc_type, p_legal_doc_type" category="Prototype">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Controls>
								<Control id="1002"/>
							</Controls>
							<ControlPoints/>
							<Features/>
						</PTAutoFill>
					</Features>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="935" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="npop" PathID="t_bphtb_registrationFormnpop" fieldSource="npop" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="936" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="npop_tkp" PathID="t_bphtb_registrationFormnpop_tkp" fieldSource="npop_tkp" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="937" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="npop_kp" PathID="t_bphtb_registrationFormnpop_kp" fieldSource="npop_kp" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="938" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="bphtb_amt" PathID="t_bphtb_registrationFormbphtb_amt" fieldSource="bphtb_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="939" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="bphtb_amt_final" PathID="t_bphtb_registrationFormbphtb_amt_final" fieldSource="bphtb_amt_final" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="940" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="bphtb_discount" PathID="t_bphtb_registrationFormbphtb_discount" fieldSource="bphtb_discount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="941" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" PathID="t_bphtb_registrationFormdescription" fieldSource="description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="942" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="market_price" PathID="t_bphtb_registrationFormmarket_price" fieldSource="market_price" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="943" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no" PathID="t_bphtb_registrationFormphone_no" fieldSource="phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="944" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_phone_no" PathID="t_bphtb_registrationFormmobile_phone_no" fieldSource="mobile_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="955" visible="Yes" fieldSourceType="CodeExpression" dataType="Float" name="total_price" PathID="t_bphtb_registrationFormtotal_price" defaultValue="0" fieldSource="$this-&gt;DataSource-&gt;land_total_price-&gt;GetValue()+$this-&gt;DataSource-&gt;building_total_price-&gt;GetValue()" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="997" fieldSourceType="DBColumn" dataType="Integer" name="t_bphtb_registration_id" PathID="t_bphtb_registrationFormt_bphtb_registration_id" fieldSource="t_bphtb_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="1005" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Integer" returnValueType="Number" name="jenis_harga_bphtb" wizardEmptyCaption="Select Value" PathID="t_bphtb_registrationFormjenis_harga_bphtb" connection="ConnSIKP" _valueOfList="3" _nameOfList="Harga Lelang" dataSource="1;Harga Transaksi;2;Harga Pasar;3;Harga Lelang" fieldSource="jenis_harga_bphtb" defaultValue="0">
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
				<Hidden id="1007" fieldSourceType="DBColumn" dataType="Float" name="nilai_doc" PathID="t_bphtb_registrationFormnilai_doc" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="1008" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="bphtb_legal_doc_description" PathID="t_bphtb_registrationFormbphtb_legal_doc_description" fieldSource="bphtb_legal_doc_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="1009" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="add_disc_percent" wizardEmptyCaption="Select Value" PathID="t_bphtb_registrationFormadd_disc_percent" connection="ConnSIKP" _valueOfList="0.75" _nameOfList="75%" dataSource="0;0%;0.25;25%;0.5;50%;0.75;75%;1;100%" fieldSource="add_disc_percent">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="1010" eventType="Client"/>
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
				<TextBox id="1011" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="add_discount" PathID="t_bphtb_registrationFormadd_discount" format="#,##0.00">
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
				<TextBox id="1014" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="prev_payment_amount" PathID="t_bphtb_registrationFormprev_payment_amount" fieldSource="prev_payment_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="1015" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="bphtb_amt_final_old" PathID="t_bphtb_registrationFormbphtb_amt_final_old" fieldSource="bphtb_amt_final_old" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="1016" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="check_potongan" PathID="t_bphtb_registrationFormcheck_potongan" fieldSource="check_potongan" checkedValue="Y" uncheckedValue="N" defaultValue="N">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="311" urlType="Relative" enableValidation="True" isDefault="False" name="BtnSelect" PathID="t_bphtb_registrationFormBtnSelect">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="1055" fieldSourceType="DBColumn" dataType="Float" name="t_bphtb_registration_id_old" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormt_bphtb_registration_id_old" fieldSource="t_bphtb_registration_id_old" caption="test">
					<Components/>
					<Events/>

					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="1056" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_area_real" PathID="t_bphtb_registrationFormland_area_real" defaultValue="0" fieldSource="land_area_real" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="1057" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_area_real" PathID="t_bphtb_registrationFormbuilding_area_real" defaultValue="0" fieldSource="building_area_real" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="1058" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_price_real" PathID="t_bphtb_registrationFormland_price_real" defaultValue="0" fieldSource="land_price_real" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="1059" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_price_real" PathID="t_bphtb_registrationFormbuilding_price_real" defaultValue="0" fieldSource="building_price_real" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="842" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="853" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="954" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="OnSubmit" type="Client">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="1001" eventType="Client"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="1004"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="896" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_customer_order_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="957" variable="t_bphtb_registration_id" parameterType="URL" dataType="Text" parameterSource="t_bphtb_registration_id" designDefaultValue="25"/>
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
				<SPParameter id="Key950" parameterName="wp_p_region_id_kec" parameterSource="wp_p_region_id_kec" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key951" parameterName="wp_p_region_id_kel" parameterSource="wp_p_region_id_kel" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="Key952" parameterName="phone_no" parameterSource="phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key953" parameterName="mobile_phone_no" parameterSource="mobile_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key954" parameterName="njop_pbb" parameterSource="njop_pbb" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key955" parameterName="object_address_name" parameterSource="object_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key956" parameterName="object_rt" parameterSource="object_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key957" parameterName="object_rw" parameterSource="object_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key958" parameterName="object_p_region_id" parameterSource="object_p_region_id" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key959" parameterName="object_p_region_id_kec" parameterSource="object_p_region_id_kec" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="Key960" parameterName="object_p_region_id_kel" parameterSource="object_p_region_id_kel" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
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
				<SPParameter id="Key1007" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" parameterName="jenis_harga_bphtb" scale="0" precision="0" parameterSource="jenis_harga_bphtb"/>
				<SPParameter id="Key1010" dataType="Text" parameterType="Control" dataSize="0" direction="Input" parameterName="bphtb_legal_doc_description" scale="0" precision="0" parameterSource="bphtb_legal_doc_description"/>
				<SPParameter id="Key1013" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" parameterName="add_disc_percent" scale="0" precision="0" parameterSource="add_disc_percent"/>
				<SPParameter id="Key1018" dataType="Text" parameterType="Control" dataSize="0" direction="Input" parameterName="check_potongan" scale="0" precision="0" parameterSource="check_potongan"/>
				<SPParameter id="Key1061" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" parameterName="i_land_area_real" scale="0" precision="0" parameterSource="land_area_real"/>
				<SPParameter id="Key1062" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" parameterName="i_land_price_real" scale="0" precision="0" parameterSource="land_price_real"/>
				<SPParameter id="Key1063" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" parameterName="i_building_area_real" scale="0" precision="0" parameterSource="building_area_real"/>
				<SPParameter id="Key1064" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" parameterName="i_building_price_real" scale="0" precision="0" parameterSource="building_price_real"/>
				<SPParameter id="Key977" parameterName="o_t_bphtb_registration_id" parameterSource="o_t_bphtb_registration_id" dataType="Numeric" parameterType="URL" dataSize="0" direction="InputOutput" scale="10" precision="6"/>
				<SPParameter id="Key978" parameterName="o_mess" parameterSource="o_mess" dataType="Char" parameterType="URL" dataSize="255" direction="InputOutput" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="910" field="wp_kota" dataType="Text" parameterType="Control" parameterSource="wp_kota"/>
				<CustomParameter id="911" field="wp_kelurahan" dataType="Text" parameterType="Control" parameterSource="wp_kelurahan"/>
				<CustomParameter id="912" field="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id"/>
				<CustomParameter id="913" field="wp_p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kecamatan"/>
				<CustomParameter id="914" field="wp_p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kelurahan"/>
				<CustomParameter id="915" field="wp_kecamatan" dataType="Text" parameterType="Control" parameterSource="wp_kecamatan"/>
				<CustomParameter id="916" field="wp_kelurahan" dataType="Text" parameterType="Control" parameterSource="object_kelurahan"/>
				<CustomParameter id="917" field="wp_p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="object_p_region_id_kelurahan"/>
				<CustomParameter id="918" field="wp_kecamatan" dataType="Text" parameterType="Control" parameterSource="object_kecamatan"/>
				<CustomParameter id="919" field="wp_p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="object_p_region_id_kecamatan"/>
				<CustomParameter id="920" field="wp_kota" dataType="Text" parameterType="Control" parameterSource="object_kota"/>
				<CustomParameter id="921" field="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="object_p_region_id"/>
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
				<SQLParameter id="1017" variable="UserLogin" dataType="Text" parameterType="Session" parameterSource="UserLogin"/>
				<SQLParameter id="1018" variable="Expr0" dataType="Text" parameterType="Expression" parameterSource="date(&quot;Y-m-d H:i:s&quot;)" format="dd-mmm-yyyy"/>
				<SQLParameter id="1019" variable="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id"/>
				<SQLParameter id="1020" variable="wp_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kel"/>
				<SQLParameter id="1021" variable="wp_name" dataType="Text" parameterType="Control" parameterSource="wp_name"/>
				<SQLParameter id="1022" variable="wp_address_name" dataType="Text" parameterType="Control" parameterSource="wp_address_name"/>
				<SQLParameter id="1023" variable="npwp" dataType="Text" parameterType="Control" parameterSource="npwp"/>
				<SQLParameter id="1024" variable="object_p_region_id_kec" dataType="Text" parameterType="Control" parameterSource="object_p_region_id_kec"/>
				<SQLParameter id="1025" variable="object_p_region_id" dataType="Text" parameterType="Control" parameterSource="object_p_region_id"/>
				<SQLParameter id="1026" variable="land_area" dataType="Float" parameterType="Control" parameterSource="land_area"/>
				<SQLParameter id="1027" variable="land_price_per_m" dataType="Float" parameterType="Control" parameterSource="land_price_per_m"/>
				<SQLParameter id="1028" variable="land_total_price" dataType="Float" parameterType="Control" parameterSource="land_total_price"/>
				<SQLParameter id="1029" variable="building_area" dataType="Float" parameterType="Control" parameterSource="building_area"/>
				<SQLParameter id="1030" variable="building_price_per_m" dataType="Float" parameterType="Control" parameterSource="building_price_per_m"/>
				<SQLParameter id="1031" variable="building_total_price" dataType="Float" parameterType="Control" parameterSource="building_total_price"/>
				<SQLParameter id="1032" variable="wp_rt" dataType="Text" parameterType="Control" parameterSource="wp_rt"/>
				<SQLParameter id="1033" variable="wp_rw" dataType="Text" parameterType="Control" parameterSource="wp_rw"/>
				<SQLParameter id="1034" variable="object_rt" dataType="Text" parameterType="Control" parameterSource="object_rt"/>
				<SQLParameter id="1035" variable="object_rw" dataType="Text" parameterType="Control" parameterSource="object_rw"/>
				<SQLParameter id="1036" variable="njop_pbb" dataType="Text" parameterType="Control" parameterSource="njop_pbb"/>
				<SQLParameter id="1037" variable="object_address_name" dataType="Text" parameterType="Control" parameterSource="object_address_name"/>
				<SQLParameter id="1038" variable="p_bphtb_legal_doc_type_id" dataType="Text" parameterType="Control" parameterSource="p_bphtb_legal_doc_type_id"/>
				<SQLParameter id="1039" variable="npop" dataType="Float" parameterType="Control" parameterSource="npop"/>
				<SQLParameter id="1040" variable="npop_tkp" dataType="Float" parameterType="Control" parameterSource="npop_tkp"/>
				<SQLParameter id="1041" variable="npop_kp" dataType="Float" parameterType="Control" parameterSource="npop_kp"/>
				<SQLParameter id="1042" variable="bphtb_amt" dataType="Float" parameterType="Control" parameterSource="bphtb_amt"/>
				<SQLParameter id="1043" variable="bphtb_amt_final" dataType="Float" parameterType="Control" parameterSource="bphtb_amt_final"/>
				<SQLParameter id="1044" variable="bphtb_discount" dataType="Float" parameterType="Control" parameterSource="bphtb_discount"/>
				<SQLParameter id="1045" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="1046" variable="market_price" dataType="Float" parameterType="Control" parameterSource="market_price"/>
				<SQLParameter id="1047" variable="mobile_phone_no" dataType="Text" parameterType="Control" parameterSource="mobile_phone_no"/>
				<SQLParameter id="1048" variable="wp_p_region_id_kec" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kec"/>
				<SQLParameter id="1049" variable="object_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="object_p_region_id_kel"/>
				<SQLParameter id="1050" variable="jenis_harga_bphtb" dataType="Text" parameterType="Control" parameterSource="jenis_harga_bphtb"/>
				<SQLParameter id="1051" variable="bphtb_legal_doc_description" dataType="Text" parameterType="Control" parameterSource="bphtb_legal_doc_description"/>
				<SQLParameter id="1052" variable="add_disc_percent" dataType="Float" parameterType="Control" parameterSource="add_disc_percent"/>
				<SQLParameter id="1053" variable="t_bphtb_registration_id" parameterType="URL" dataType="Float" parameterSource="t_bphtb_registration_id" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="778" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
				<TableParameter id="995" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
				<TableParameter id="996" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="737" field="updated_by" dataType="Text" parameterType="Session" parameterSource="UserLogin" omitIfEmpty="True"/>
				<CustomParameter id="739" field="updated_date" dataType="Text" parameterType="Expression" parameterSource="date(&quot;Y-m-d H:i:s&quot;)" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="960" field="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id" omitIfEmpty="True"/>
				<CustomParameter id="962" field="wp_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kel" omitIfEmpty="True"/>
				<CustomParameter id="964" field="wp_name" dataType="Text" parameterType="Control" parameterSource="wp_name" omitIfEmpty="True"/>
				<CustomParameter id="965" field="wp_address_name" dataType="Text" parameterType="Control" parameterSource="wp_address_name" omitIfEmpty="True"/>
				<CustomParameter id="966" field="npwp" dataType="Text" parameterType="Control" parameterSource="npwp" omitIfEmpty="True"/>
				<CustomParameter id="970" field="object_p_region_id_kec" dataType="Text" parameterType="Control" parameterSource="object_p_region_id_kec" omitIfEmpty="True"/>
				<CustomParameter id="972" field="object_p_region_id" dataType="Text" parameterType="Control" parameterSource="object_p_region_id" omitIfEmpty="True"/>
				<CustomParameter id="973" field="land_area" dataType="Float" parameterType="Control" parameterSource="land_area" omitIfEmpty="True"/>
				<CustomParameter id="974" field="land_price_per_m" dataType="Float" parameterType="Control" parameterSource="land_price_per_m" omitIfEmpty="True"/>
				<CustomParameter id="975" field="land_total_price" dataType="Float" parameterType="Control" parameterSource="land_total_price" omitIfEmpty="True"/>
				<CustomParameter id="976" field="building_area" dataType="Float" parameterType="Control" parameterSource="building_area" omitIfEmpty="True"/>
				<CustomParameter id="977" field="building_price_per_m" dataType="Float" parameterType="Control" parameterSource="building_price_per_m" omitIfEmpty="True"/>
				<CustomParameter id="978" field="building_total_price" dataType="Float" parameterType="Control" parameterSource="building_total_price" omitIfEmpty="True"/>
				<CustomParameter id="979" field="wp_rt" dataType="Text" parameterType="Control" parameterSource="wp_rt" omitIfEmpty="True"/>
				<CustomParameter id="980" field="wp_rw" dataType="Text" parameterType="Control" parameterSource="wp_rw" omitIfEmpty="True"/>
				<CustomParameter id="981" field="object_rt" dataType="Text" parameterType="Control" parameterSource="object_rt" omitIfEmpty="True"/>
				<CustomParameter id="982" field="object_rw" dataType="Text" parameterType="Control" parameterSource="object_rw" omitIfEmpty="True"/>
				<CustomParameter id="983" field="njop_pbb" dataType="Text" parameterType="Control" parameterSource="njop_pbb" omitIfEmpty="True"/>
				<CustomParameter id="984" field="object_address_name" dataType="Text" parameterType="Control" parameterSource="object_address_name" omitIfEmpty="True"/>
				<CustomParameter id="985" field="p_bphtb_legal_doc_type_id" dataType="Text" parameterType="Control" parameterSource="p_bphtb_legal_doc_type_id" omitIfEmpty="True"/>
				<CustomParameter id="986" field="npop" dataType="Float" parameterType="Control" parameterSource="npop" omitIfEmpty="True"/>
				<CustomParameter id="987" field="npop_tkp" dataType="Float" parameterType="Control" parameterSource="npop_tkp" omitIfEmpty="True"/>
				<CustomParameter id="988" field="npop_kp" dataType="Float" parameterType="Control" parameterSource="npop_kp" omitIfEmpty="True"/>
				<CustomParameter id="989" field="bphtb_amt" dataType="Float" parameterType="Control" parameterSource="bphtb_amt" omitIfEmpty="True"/>
				<CustomParameter id="990" field="bphtb_amt_final" dataType="Float" parameterType="Control" parameterSource="bphtb_amt_final" omitIfEmpty="True"/>
				<CustomParameter id="991" field="bphtb_discount" dataType="Float" parameterType="Control" parameterSource="bphtb_discount" omitIfEmpty="True"/>
				<CustomParameter id="992" field="description" dataType="Text" parameterType="Control" parameterSource="description" omitIfEmpty="True"/>
				<CustomParameter id="993" field="market_price" dataType="Float" parameterType="Control" parameterSource="market_price" omitIfEmpty="True"/>
				<CustomParameter id="994" field="mobile_phone_no" dataType="Text" parameterType="Control" parameterSource="mobile_phone_no" omitIfEmpty="True"/>
				<CustomParameter id="998" field="wp_p_region_id_kec" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="wp_p_region_id_kec"/>
				<CustomParameter id="999" field="object_p_region_id_kel" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="object_p_region_id_kel"/>
				<CustomParameter id="1006" field="jenis_harga_bphtb" dataType="Text" parameterType="Control" omitIfEmpty="True" parameterSource="jenis_harga_bphtb"/>
				<CustomParameter id="1012" field="bphtb_legal_doc_description" dataType="Text" parameterType="Control" omitIfEmpty="True" parameterSource="bphtb_legal_doc_description"/>
				<CustomParameter id="1013" field="add_disc_percent" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="add_disc_percent"/>
				<CustomParameter id="1060" field="land_area_real" dataType="Integer" parameterType="Control" omitIfEmpty="True" parameterSource="land_area_real"/>
				<CustomParameter id="1061" field="land_price_real" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="land_price_real"/>
				<CustomParameter id="1062" field="building_area_real" dataType="Integer" parameterType="Control" omitIfEmpty="True" parameterSource="building_area_real"/>
				<CustomParameter id="1063" field="building_price_real" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="building_price_real"/>
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
				<TableParameter id="1000" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_bphtb_registration_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_bphtb_registration.php" forShow="True" url="t_bphtb_registration.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="1003"/>
			</Actions>
		</Event>
	</Events>
</Page>
