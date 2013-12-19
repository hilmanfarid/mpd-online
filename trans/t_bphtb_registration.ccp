<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_bphtb_registrationForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_bphtb_registrationForm" activeCollection="ISPParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="Procedure" parameterTypeListName="ParameterTypeList" customUpdateType="Procedure" customInsertType="Procedure" customUpdate="f_crud_vat_reg" customDelete="f_crud_vat_reg" customInsert="f_bphtb_registration" dataSource="SELECT * 
FROM v_vat_registration
WHERE t_customer_order_id = {t_customer_order_id} ">
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
								<Action actionName="Confirmation Message" actionCategory="General" id="98" message="Delete record?"/>
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
				<Hidden id="887" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormwp_p_region_id_kecamatan" fieldSource="wp_p_region_id_kecamatan" caption="Kecamatan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="889" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormwp_p_region_id_kelurahan" fieldSource="wp_p_region_id_kelurahan" caption="Kelurahan - WP" required="True">
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
				<TextBox id="898" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" PathID="t_bphtb_registrationFormwp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="899" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" PathID="t_bphtb_registrationFormwp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="900" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwp" PathID="t_bphtb_registrationFormnpwp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="901" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kelurahan" fieldSource="wp_kelurahan" required="True" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_bphtb_registrationFormobject_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="903" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormobject_p_region_id_kelurahan" fieldSource="wp_p_region_id_kelurahan" caption="Kelurahan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="904" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kecamatan" caption="Kecamatan - WP" fieldSource="wp_kecamatan" required="True" PathID="t_bphtb_registrationFormobject_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="906" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormobject_p_region_id_kecamatan" fieldSource="wp_p_region_id_kecamatan" caption="Kecamatan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="907" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_kota" fieldSource="wp_kota" required="True" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_bphtb_registrationFormobject_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="909" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_bphtb_registrationFormobject_p_region_id" fieldSource="wp_p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="922" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_area" PathID="t_bphtb_registrationFormland_area" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="923" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_price_per_m" PathID="t_bphtb_registrationFormland_price_per_m" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="924" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="land_total_price" PathID="t_bphtb_registrationFormland_total_price" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="925" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_area" PathID="t_bphtb_registrationFormbuilding_area" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="926" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_price_per_m" PathID="t_bphtb_registrationFormbuilding_price_per_m" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="927" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="building_total_price" PathID="t_bphtb_registrationFormbuilding_total_price" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="928" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_rt" PathID="t_bphtb_registrationFormwp_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="929" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_rw" PathID="t_bphtb_registrationFormwp_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="930" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_rt" PathID="t_bphtb_registrationFormobject_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="931" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_rw" PathID="t_bphtb_registrationFormobject_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="932" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="njop_pbb" PathID="t_bphtb_registrationFormnjop_pbb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="933" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="object_address_name" PathID="t_bphtb_registrationFormobject_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="934" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="p_bphtb_legal_doc_type_id" PathID="t_bphtb_registrationFormp_bphtb_legal_doc_type_id" sourceType="SQL" connection="ConnSIKP" dataSource="select p_bphtb_legal_doc_type_id,code
from p_bphtb_legal_doc_type bphtb_legal
left join p_legal_doc_type legal on legal.p_legal_doc_type_id = bphtb_legal.p_legal_doc_type_id
" boundColumn="p_bphtb_legal_doc_type_id" textColumn="code" features="(assigned)">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="956"/>
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
								<Control id="952" name="npop_tkp" source="npoptkp" propertyValue="value" sourceId="936"/>
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
				<TextBox id="935" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="npop" PathID="t_bphtb_registrationFormnpop">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="936" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="npop_tkp" PathID="t_bphtb_registrationFormnpop_tkp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="937" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="npop_kp" PathID="t_bphtb_registrationFormnpop_kp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="938" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="bphtb_amt" PathID="t_bphtb_registrationFormbphtb_amt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="939" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="bphtb_amt_final" PathID="t_bphtb_registrationFormbphtb_amt_final">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="940" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="bphtb_discount" PathID="t_bphtb_registrationFormbphtb_discount">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="941" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" PathID="t_bphtb_registrationFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="942" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="market_price" PathID="t_bphtb_registrationFormmarket_price">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="943" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no" PathID="t_bphtb_registrationFormphone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="944" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_phone_no" PathID="t_bphtb_registrationFormmobile_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="955" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_price" PathID="t_bphtb_registrationFormtotal_price" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="842"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="853"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="954"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="896" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_customer_order_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="897" parameterType="URL" variable="t_customer_order_id" dataType="Float" parameterSource="t_customer_order_id"/>
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
			</USQLParameters>
			<UConditions>
				<TableParameter id="777" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_customer_order_id"/>
				<TableParameter id="778" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="736" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="737" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="738" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="739" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="740" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="741" field="registration_date" dataType="Text" parameterType="Control" parameterSource="registration_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="742" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="743" field="kelurahan_code" dataType="Text" parameterType="Control" parameterSource="kelurahan_code"/>
				<CustomParameter id="744" field="kecamatan_code" dataType="Text" parameterType="Control" parameterSource="kecamatan_code"/>
				<CustomParameter id="745" field="kota_code" dataType="Text" parameterType="Control" parameterSource="kota_code"/>
				<CustomParameter id="746" field="p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kelurahan"/>
				<CustomParameter id="747" field="p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kecamatan"/>
				<CustomParameter id="748" field="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<CustomParameter id="749" field="kelurahan_own_code" dataType="Text" parameterType="Control" parameterSource="kelurahan_own_code"/>
				<CustomParameter id="750" field="kecamatan_own_code" dataType="Text" parameterType="Control" parameterSource="kecamatan_own_code"/>
				<CustomParameter id="751" field="kota_own_code" dataType="Text" parameterType="Control" parameterSource="kota_own_code"/>
				<CustomParameter id="752" field="p_region_id_kel_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel_owner"/>
				<CustomParameter id="753" field="p_region_id_kec_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec_owner"/>
				<CustomParameter id="754" field="p_region_id_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_owner"/>
				<CustomParameter id="755" field="company_name" dataType="Text" parameterType="Control" parameterSource="company_name"/>
				<CustomParameter id="756" field="address_name" dataType="Text" parameterType="Control" parameterSource="address_name"/>
				<CustomParameter id="757" field="job_position_code" dataType="Text" parameterType="Control" parameterSource="job_position_code"/>
				<CustomParameter id="758" field="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id"/>
				<CustomParameter id="759" field="company_brand" dataType="Text" parameterType="Control" parameterSource="company_brand"/>
				<CustomParameter id="760" field="address_no" dataType="Text" parameterType="Control" parameterSource="address_no"/>
				<CustomParameter id="761" field="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt"/>
				<CustomParameter id="762" field="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw"/>
				<CustomParameter id="763" field="address_no_owner" dataType="Text" parameterType="Control" parameterSource="address_no_owner"/>
				<CustomParameter id="764" field="address_rt_owner" dataType="Text" parameterType="Control" parameterSource="address_rt_owner"/>
				<CustomParameter id="765" field="address_rw_owner" dataType="Text" parameterType="Control" parameterSource="address_rw_owner"/>
				<CustomParameter id="766" field="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no"/>
				<CustomParameter id="767" field="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no"/>
				<CustomParameter id="768" field="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code"/>
				<CustomParameter id="769" field="phone_no_owner" dataType="Text" parameterType="Control" parameterSource="phone_no_owner"/>
				<CustomParameter id="770" field="company_owner" dataType="Text" parameterType="Control" parameterSource="company_owner"/>
				<CustomParameter id="771" field="mobile_no_owner" dataType="Text" parameterType="Control" parameterSource="mobile_no_owner"/>
				<CustomParameter id="772" field="fax_no_owner" dataType="Text" parameterType="Control" parameterSource="fax_no_owner"/>
				<CustomParameter id="773" field="zip_code_owner" dataType="Text" parameterType="Control" parameterSource="zip_code_owner"/>
				<CustomParameter id="774" field="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no"/>
				<CustomParameter id="775" field="address_name_owner" dataType="Text" parameterType="Control" parameterSource="address_name_owner"/>
				<CustomParameter id="776" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
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
	</Events>
</Page>
