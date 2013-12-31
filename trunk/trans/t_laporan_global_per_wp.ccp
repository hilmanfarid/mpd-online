<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_laporan_global_per_wp" returnPage="t_laporan_global_per_wp.ccp" PathID="t_laporan_global_per_wp">
<Components>
<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rqst_type_code" PathID="t_laporan_global_per_wprqst_type_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_laporan_global_per_wpButton1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Hidden id="9" fieldSourceType="DBColumn" dataType="Text" name="cetak_laporan" PathID="t_laporan_global_per_wpcetak_laporan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="date_start_laporan" format="yyyy-mm-dd" required="True" PathID="t_laporan_global_per_wpdate_start_laporan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="15" name="DatePicker_date_start_laporan1" style="../Styles/sikp/Style.css" control="date_start_laporan" PathID="t_laporan_global_per_wpDatePicker_date_start_laporan1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="date_end_laporan" format="yyyy-mm-dd" required="True" PathID="t_laporan_global_per_wpdate_end_laporan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="17" name="DatePicker_end_start_laporan1" style="../Styles/sikp/Style.css" control="date_end_laporan" PathID="t_laporan_global_per_wpDatePicker_end_start_laporan1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<Hidden id="18" fieldSourceType="DBColumn" dataType="Text" name="p_rqst_type_id" PathID="t_laporan_global_per_wpp_rqst_type_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
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
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_laporan_global_per_wp_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_laporan_global_per_wp.php" forShow="True" url="t_laporan_global_per_wp.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="10"/>
			</Actions>
		</Event>
	</Events>
</Page>
