<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\lov" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="LOV" wizardCaption="Search P CUSTOMER SEGMENT " wizardOrientation="Horizontal" wizardFormMethod="post" returnPage="lov_bphtb_ws.ccp" PathID="LOV" pasteActions="pasteActions" connection="ConnSIKP" pasteAsReplace="pasteAsReplace">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="NOP_SEARCH" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="LOVNOP_SEARCH" fieldSource="NOP_SEARCH">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="FORM" PathID="LOVFORM">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="OBJ" PathID="LOVOBJ">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="LOVButton_DoSearch">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="50" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="48" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="TAHUN_SEARCH" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVTAHUN_SEARCH" sourceType="SQL" connection="ConnSIKP" dataSource="SELECT * 
FROM p_year_period 
order by year_code DESC" boundColumn="year_code" textColumn="year_code" fieldSource="TAHUN_SEARCH" defaultValue="date(&quot;Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
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
		<Record id="51" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="bphtb_wsForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="bphtb_wsForm" activeCollection="UFormElements" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="Table" parameterTypeListName="ParameterTypeList" customUpdateType="Table" customInsertType="Procedure" customDelete="t_bphtb_registration" customInsert="f_bphtb_registration" dataSource="select a.*,
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
				<Button id="53" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="bphtb_wsFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="NOP" PathID="bphtb_wsFormNOP" fieldSource="NOP">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="281" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kota" PathID="bphtb_wsFormkota" fieldSource="kota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="282" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan" PathID="bphtb_wsFormkecamatan" fieldSource="kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="283" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kelurahan" PathID="bphtb_wsFormkelurahan" fieldSource="kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="284" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="jalan" PathID="bphtb_wsFormjalan" fieldSource="jalan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="285" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rt" PathID="bphtb_wsFormrt" fieldSource="rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="286" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rw" PathID="bphtb_wsFormrw" fieldSource="kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="287" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="luas_bumi" PathID="bphtb_wsFormluas_bumi" fieldSource="luas_bumi">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="288" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="luas_bangunan" PathID="bphtb_wsFormluas_bangunan" fieldSource="luas_bangunan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="289" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="njop_bangunan" PathID="bphtb_wsFormnjop_bangunan" fieldSource="njop_bangunan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="290" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="njop_bumi" PathID="bphtb_wsFormnjop_bumi" fieldSource="njop_bumi">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="291" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="njop_pbb" PathID="bphtb_wsFormnjop_pbb" fieldSource="njop_pbb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="292" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="pbb_terhutang" PathID="bphtb_wsFormpbb_terhutang" fieldSource="pbb_terhutang">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="295" urlType="Relative" enableValidation="True" isDefault="False" name="pilih" wizardCaption="Search" PathID="bphtb_wsFormpilih">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="296" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="297" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="status_bayar" PathID="bphtb_wsFormstatus_bayar" fieldSource="status_bayar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="60" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="61" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="62" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="OnSubmit" type="Client">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="63" eventType="Client"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="64" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="293"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="65" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_customer_order_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="66" variable="t_bphtb_registration_id" parameterType="URL" dataType="Text" parameterSource="t_bphtb_registration_id" designDefaultValue="25"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters>
				<SPParameter id="67" parameterName="wp_name" parameterSource="wp_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="0" precision="0" defaultValue="&quot;-&quot;"/>
				<SPParameter id="68" parameterName="npwp" parameterSource="npwp" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="0" precision="0" defaultValue="&quot;-&quot;"/>
				<SPParameter id="69" parameterName="wp_address_name" parameterSource="wp_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="0" precision="0" defaultValue="&quot;-&quot;"/>
				<SPParameter id="70" parameterName="wp_rt" parameterSource="wp_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="0" precision="0" defaultValue="&quot;-&quot;"/>
				<SPParameter id="71" parameterName="wp_rw" parameterSource="wp_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="0" precision="0" defaultValue="&quot;-&quot;"/>
				<SPParameter id="72" parameterName="wp_p_region_id" parameterSource="wp_p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="73" parameterName="wp_p_region_id_kec" parameterSource="wp_p_region_id_kec" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="74" parameterName="wp_p_region_id_kel" parameterSource="wp_p_region_id_kel" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="75" parameterName="phone_no" parameterSource="phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="76" parameterName="mobile_phone_no" parameterSource="mobile_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="77" parameterName="njop_pbb" parameterSource="njop_pbb" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="78" parameterName="object_address_name" parameterSource="object_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="79" parameterName="object_rt" parameterSource="object_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="80" parameterName="object_rw" parameterSource="object_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="81" parameterName="object_p_region_id" parameterSource="object_p_region_id" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="82" parameterName="object_p_region_id_kec" parameterSource="object_p_region_id_kec" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="83" parameterName="object_p_region_id_kel" parameterSource="object_p_region_id_kel" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="84" parameterName="p_bphtb_legal_doc_type_id" parameterSource="p_bphtb_legal_doc_type_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="85" parameterName="land_area" parameterSource="land_area" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="86" parameterName="land_price_per_m" parameterSource="land_price_per_m" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="87" parameterName="land_total_price" parameterSource="land_total_price" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="88" parameterName="building_area" parameterSource="building_area" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="89" parameterName="building_price_per_m" parameterSource="building_price_per_m" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="90" parameterName="building_total_price" parameterSource="building_total_price" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="91" parameterName="market_price" parameterSource="market_price" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="92" parameterName="npop" parameterSource="npop" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="93" parameterName="npop_tkp" parameterSource="npop_tkp" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="94" parameterName="npop_kp" parameterSource="npop_kp" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="95" parameterName="bphtb_amt" parameterSource="bphtb_amt" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="96" parameterName="bphtb_discount" parameterSource="bphtb_discount" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="97" parameterName="bphtb_amt_final" parameterSource="bphtb_amt_final" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6" defaultValue="0"/>
				<SPParameter id="98" parameterName="description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6" defaultValue="&quot;-&quot;"/>
				<SPParameter id="99" parameterName="i_user" parameterSource="UserLogin" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="100" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" parameterName="jenis_harga_bphtb" scale="0" precision="0" parameterSource="jenis_harga_bphtb"/>
				<SPParameter id="101" dataType="Text" parameterType="Control" dataSize="0" direction="Input" parameterName="bphtb_legal_doc_description" scale="0" precision="0" parameterSource="bphtb_legal_doc_description"/>
				<SPParameter id="102" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" parameterName="add_disc_percent" scale="0" precision="0" parameterSource="add_disc_percent"/>
				<SPParameter id="103" parameterName="o_t_bphtb_registration_id" parameterSource="o_t_bphtb_registration_id" dataType="Numeric" parameterType="URL" dataSize="0" direction="InputOutput" scale="10" precision="6"/>
				<SPParameter id="104" parameterName="o_mess" parameterSource="o_mess" dataType="Char" parameterType="URL" dataSize="255" direction="InputOutput" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="105" field="wp_kota" dataType="Text" parameterType="Control" parameterSource="wp_kota"/>
				<CustomParameter id="106" field="wp_kelurahan" dataType="Text" parameterType="Control" parameterSource="wp_kelurahan"/>
				<CustomParameter id="107" field="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id"/>
				<CustomParameter id="108" field="wp_p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kecamatan"/>
				<CustomParameter id="109" field="wp_p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kelurahan"/>
				<CustomParameter id="110" field="wp_kecamatan" dataType="Text" parameterType="Control" parameterSource="wp_kecamatan"/>
				<CustomParameter id="111" field="wp_kelurahan" dataType="Text" parameterType="Control" parameterSource="object_kelurahan"/>
				<CustomParameter id="112" field="wp_p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="object_p_region_id_kelurahan"/>
				<CustomParameter id="113" field="wp_kecamatan" dataType="Text" parameterType="Control" parameterSource="object_kecamatan"/>
				<CustomParameter id="114" field="wp_p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="object_p_region_id_kecamatan"/>
				<CustomParameter id="115" field="wp_kota" dataType="Text" parameterType="Control" parameterSource="object_kota"/>
				<CustomParameter id="116" field="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="object_p_region_id"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="117" dataType="Char" parameterType="URL" dataSize="255" direction="ReturnValue" scale="0" precision="0" parameterName="o_res" parameterSource="o_res"/>
				<SPParameter id="118" parameterName="icode" parameterSource="icode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="0" precision="0"/>
				<SPParameter id="119" parameterName="iuser" parameterSource="CCGetUserLogin()" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="120" parameterName="cusorderid" parameterSource="t_customer_order_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="121" parameterName="regionidkel" parameterSource="p_region_id_kelurahan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="122" parameterName="regionidkec" parameterSource="p_region_id_kecamatan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="123" parameterName="regionid" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="124" parameterName="regionidkelown" parameterSource="p_region_id_kel_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="125" parameterName="regionidkecown" parameterSource="p_region_id_kec_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="126" parameterName="regionidown" parameterSource="p_region_id_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="127" parameterName="companyname" parameterSource="company_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="128" parameterName="addressname" parameterSource="address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="129" parameterName="jobid" parameterSource="p_job_position_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="130" parameterName="companybrand" parameterSource="company_brand" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="131" parameterName="addressno" parameterSource="address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="132" parameterName="addressrt" parameterSource="address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="133" parameterName="addressrw" parameterSource="address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="134" parameterName="addressnoown" parameterSource="address_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="135" parameterName="addressrtown" parameterSource="address_rt_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="136" parameterName="addressrwown" parameterSource="address_rw_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="137" parameterName="phoneno" parameterSource="phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="138" parameterName="faxno" parameterSource="fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="139" parameterName="zipcode" parameterSource="zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="140" parameterName="phonenoown" parameterSource="phone_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="141" parameterName="companyown" parameterSource="company_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="142" parameterName="mobilenoown" parameterSource="mobile_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="143" parameterName="faxnoown" parameterSource="fax_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="144" parameterName="zipcodeown" parameterSource="zip_code_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="145" parameterName="mobileno" parameterSource="mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="146" parameterName="addressnameown" parameterSource="address_name_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="147" parameterName="i_email" parameterSource="email" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="148" parameterName="vattypedtlid" parameterSource="p_vat_type_dtl_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="149" parameterName="wpusername" parameterSource="wp_user_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="150" parameterName="wpuserpwd" parameterSource="wp_user_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="151" parameterName="wpname" parameterSource="wp_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="152" parameterName="wpaddressname" parameterSource="wp_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="153" parameterName="wpaddressno" parameterSource="wp_address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="154" parameterName="wprt" parameterSource="wp_address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="155" parameterName="wprw" parameterSource="wp_address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="156" parameterName="wpkel" parameterSource="wp_p_region_id_kelurahan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="157" parameterName="wpkec" parameterSource="wp_p_region_id_kecamatan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="158" parameterName="wpkota" parameterSource="wp_p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="159" parameterName="wpphoneno" parameterSource="wp_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="160" parameterName="wpmobileno" parameterSource="wp_mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="161" parameterName="wpfaxno" parameterSource="wp_fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="162" parameterName="wpzipcode" parameterSource="wp_zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="163" parameterName="wpemail" parameterSource="wp_email" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="164" parameterName="brandaddress" parameterSource="brand_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="165" parameterName="brandno" parameterSource="brand_address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="166" parameterName="brandrt" parameterSource="brand_address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="167" parameterName="brandrw" parameterSource="brand_address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="168" parameterName="brandkel" parameterSource="brand_p_region_id_kel" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="169" parameterName="brandkec" parameterSource="brand_p_region_id_kec" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="170" parameterName="brandkota" parameterSource="brand_p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="171" parameterName="brandphoneno" parameterSource="brand_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="172" parameterName="brandmobileno" parameterSource="brand_mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="173" parameterName="brandfaxno" parameterSource="brand_fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="174" parameterName="brandzipcode" parameterSource="brand_zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="175" parameterName="idvat" parameterSource="t_vat_registration_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="176" parameterName="questionid" parameterSource="p_private_question_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="177" parameterName="privateanswer" parameterSource="private_answer" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="178" parameterName="i_mode" parameterSource="'U'" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
			</USQLParameters>
			<UConditions>
				<TableParameter id="179" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
				<TableParameter id="180" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
				<TableParameter id="181" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="182" field="updated_by" dataType="Text" parameterType="Session" parameterSource="UserLogin" omitIfEmpty="True"/>
				<CustomParameter id="183" field="updated_date" dataType="Text" parameterType="Expression" parameterSource="date(&quot;Y-m-d H:i:s&quot;)" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="184" field="wp_p_region_id" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id" omitIfEmpty="True"/>
				<CustomParameter id="185" field="wp_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="wp_p_region_id_kel" omitIfEmpty="True"/>
				<CustomParameter id="186" field="wp_name" dataType="Text" parameterType="Control" parameterSource="wp_name" omitIfEmpty="True"/>
				<CustomParameter id="187" field="wp_address_name" dataType="Text" parameterType="Control" parameterSource="wp_address_name" omitIfEmpty="True"/>
				<CustomParameter id="188" field="npwp" dataType="Text" parameterType="Control" parameterSource="npwp" omitIfEmpty="True"/>
				<CustomParameter id="189" field="object_p_region_id_kec" dataType="Text" parameterType="Control" parameterSource="object_p_region_id_kec" omitIfEmpty="True"/>
				<CustomParameter id="190" field="object_p_region_id" dataType="Text" parameterType="Control" parameterSource="object_p_region_id" omitIfEmpty="True"/>
				<CustomParameter id="191" field="land_area" dataType="Float" parameterType="Control" parameterSource="land_area" omitIfEmpty="True"/>
				<CustomParameter id="192" field="land_price_per_m" dataType="Float" parameterType="Control" parameterSource="land_price_per_m" omitIfEmpty="True"/>
				<CustomParameter id="193" field="land_total_price" dataType="Float" parameterType="Control" parameterSource="land_total_price" omitIfEmpty="True"/>
				<CustomParameter id="194" field="building_area" dataType="Float" parameterType="Control" parameterSource="building_area" omitIfEmpty="True"/>
				<CustomParameter id="195" field="building_price_per_m" dataType="Float" parameterType="Control" parameterSource="building_price_per_m" omitIfEmpty="True"/>
				<CustomParameter id="196" field="building_total_price" dataType="Float" parameterType="Control" parameterSource="building_total_price" omitIfEmpty="True"/>
				<CustomParameter id="197" field="wp_rt" dataType="Text" parameterType="Control" parameterSource="wp_rt" omitIfEmpty="True"/>
				<CustomParameter id="198" field="wp_rw" dataType="Text" parameterType="Control" parameterSource="wp_rw" omitIfEmpty="True"/>
				<CustomParameter id="199" field="object_rt" dataType="Text" parameterType="Control" parameterSource="object_rt" omitIfEmpty="True"/>
				<CustomParameter id="200" field="object_rw" dataType="Text" parameterType="Control" parameterSource="object_rw" omitIfEmpty="True"/>
				<CustomParameter id="201" field="njop_pbb" dataType="Text" parameterType="Control" parameterSource="njop_pbb" omitIfEmpty="True"/>
				<CustomParameter id="202" field="object_address_name" dataType="Text" parameterType="Control" parameterSource="object_address_name" omitIfEmpty="True"/>
				<CustomParameter id="203" field="p_bphtb_legal_doc_type_id" dataType="Text" parameterType="Control" parameterSource="p_bphtb_legal_doc_type_id" omitIfEmpty="True"/>
				<CustomParameter id="204" field="npop" dataType="Float" parameterType="Control" parameterSource="npop" omitIfEmpty="True"/>
				<CustomParameter id="205" field="npop_tkp" dataType="Float" parameterType="Control" parameterSource="npop_tkp" omitIfEmpty="True"/>
				<CustomParameter id="206" field="npop_kp" dataType="Float" parameterType="Control" parameterSource="npop_kp" omitIfEmpty="True"/>
				<CustomParameter id="207" field="bphtb_amt" dataType="Float" parameterType="Control" parameterSource="bphtb_amt" omitIfEmpty="True"/>
				<CustomParameter id="208" field="bphtb_amt_final" dataType="Float" parameterType="Control" parameterSource="bphtb_amt_final" omitIfEmpty="True"/>
				<CustomParameter id="209" field="bphtb_discount" dataType="Float" parameterType="Control" parameterSource="bphtb_discount" omitIfEmpty="True"/>
				<CustomParameter id="210" field="description" dataType="Text" parameterType="Control" parameterSource="description" omitIfEmpty="True"/>
				<CustomParameter id="211" field="market_price" dataType="Float" parameterType="Control" parameterSource="market_price" omitIfEmpty="True"/>
				<CustomParameter id="212" field="mobile_phone_no" dataType="Text" parameterType="Control" parameterSource="mobile_phone_no" omitIfEmpty="True"/>
				<CustomParameter id="213" field="wp_p_region_id_kec" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="wp_p_region_id_kec"/>
				<CustomParameter id="214" field="object_p_region_id_kel" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="object_p_region_id_kel"/>
				<CustomParameter id="215" field="jenis_harga_bphtb" dataType="Text" parameterType="Control" omitIfEmpty="True" parameterSource="jenis_harga_bphtb"/>
				<CustomParameter id="216" field="bphtb_legal_doc_description" dataType="Text" parameterType="Control" omitIfEmpty="True" parameterSource="bphtb_legal_doc_description"/>
				<CustomParameter id="217" field="add_disc_percent" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="add_disc_percent"/>
			</UFormElements>
			<DSPParameters>
				<SPParameter id="218" dataType="Char" parameterType="URL" dataSize="255" direction="ReturnValue" scale="0" precision="0"/>
				<SPParameter id="219" parameterName="icode" parameterSource="icode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="0" precision="0"/>
				<SPParameter id="220" parameterName="iuser" parameterSource="iuser" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="0" precision="0"/>
				<SPParameter id="221" parameterName="cusorderid" parameterSource="cusorderid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="222" parameterName="regionidkel" parameterSource="regionidkel" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="223" parameterName="regionidkec" parameterSource="regionidkec" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="224" parameterName="regionid" parameterSource="regionid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="225" parameterName="regionidkelown" parameterSource="regionidkelown" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="226" parameterName="regionidkecown" parameterSource="regionidkecown" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="227" parameterName="regionidown" parameterSource="regionidown" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="228" parameterName="companyname" parameterSource="companyname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="229" parameterName="addressname" parameterSource="addressname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="230" parameterName="jobid" parameterSource="jobid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="231" parameterName="companybrand" parameterSource="companybrand" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="232" parameterName="addressno" parameterSource="addressno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="233" parameterName="addressrt" parameterSource="addressrt" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="234" parameterName="addressrw" parameterSource="addressrw" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="235" parameterName="addressnoown" parameterSource="addressnoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="236" parameterName="addressrtown" parameterSource="addressrtown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="237" parameterName="addressrwown" parameterSource="addressrwown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="238" parameterName="phoneno" parameterSource="phoneno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="239" parameterName="faxno" parameterSource="faxno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="240" parameterName="zipcode" parameterSource="zipcode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="241" parameterName="phonenoown" parameterSource="phonenoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="242" parameterName="companyown" parameterSource="companyown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="243" parameterName="mobilenoown" parameterSource="mobilenoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="244" parameterName="faxnoown" parameterSource="faxnoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="245" parameterName="zipcodeown" parameterSource="zipcodeown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="246" parameterName="mobileno" parameterSource="mobileno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="247" parameterName="addressnameown" parameterSource="addressnameown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="248" parameterName="i_email" parameterSource="i_email" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="249" parameterName="vattypedtlid" parameterSource="vattypedtlid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="250" parameterName="wpusername" parameterSource="wpusername" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="251" parameterName="wpuserpwd" parameterSource="wpuserpwd" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="252" parameterName="wpname" parameterSource="wpname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="253" parameterName="wpaddressname" parameterSource="wpaddressname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="254" parameterName="wpaddressno" parameterSource="wpaddressno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="255" parameterName="wprt" parameterSource="wprt" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="256" parameterName="wprw" parameterSource="wprw" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="257" parameterName="wpkel" parameterSource="wpkel" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="258" parameterName="wpkec" parameterSource="wpkec" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="259" parameterName="wpkota" parameterSource="wpkota" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="260" parameterName="wpphoneno" parameterSource="wpphoneno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="261" parameterName="wpmobileno" parameterSource="wpmobileno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="262" parameterName="wpfaxno" parameterSource="wpfaxno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="263" parameterName="wpzipcode" parameterSource="wpzipcode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="264" parameterName="wpemail" parameterSource="wpemail" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="265" parameterName="brandaddress" parameterSource="brandaddress" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="266" parameterName="brandno" parameterSource="brandno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="267" parameterName="brandrt" parameterSource="brandrt" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="268" parameterName="brandrw" parameterSource="brandrw" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="269" parameterName="brandkel" parameterSource="brandkel" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="270" parameterName="brandkec" parameterSource="brandkec" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="271" parameterName="brandkota" parameterSource="brandkota" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="272" parameterName="brandphoneno" parameterSource="brandphoneno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="273" parameterName="brandmobileno" parameterSource="brandmobileno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="274" parameterName="brandfaxno" parameterSource="brandfaxno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="275" parameterName="brandzipcode" parameterSource="brandzipcode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="276" parameterName="idvat" parameterSource="t_vat_registration_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="277" parameterName="questionid" parameterSource="questionid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="278" parameterName="privateanswer" parameterSource="privateanswer" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="279" parameterName="i_mode" parameterSource="'D'" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
			</DSPParameters>
			<DSQLParameters>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="280" conditionType="Parameter" useIsNull="False" field="t_bphtb_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_bphtb_registration_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="lov_bphtb_ws.php" forShow="True" url="lov_bphtb_ws.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="lov_bphtb_ws_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="294"/>
			</Actions>
		</Event>
	</Events>
</Page>
